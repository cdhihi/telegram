<template>
  <v-card>
    <v-toolbar flat height="64px">
      <v-toolbar-title>{{ $t("App.groupManager") }}</v-toolbar-title>
    </v-toolbar>

    <v-card-title>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        :label="$t('Sys.search')"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="desserts"
      :search="search"
      :rows-per-page-text="$t('App.perPageText')"
    >
      <template v-slot:items="props">
        <td>{{ props.item.id }}</td>
        <td class="text-xs-center">{{ props.item.title }}</td>
        <td class="text-xs-center">{{ props.item.chat_id }}</td>
        <td class="text-xs-center">{{ props.item.create_time }}</td>
        <td class="text-xs-center">{{ props.item.update_time }}</td>
        <td class="text-xs-center">
          <a-switch
            v-model="props.item.status"
            :checkedChildren="$t('Sys.enable')"
            :unCheckedChildren="$t('Sys.disable')"
            @change="setState(props)"
          ></a-switch>
        </td>

      </template>
    </v-data-table>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card ref="user">
        <v-card-title>
          <span class="headline">{{ $t("App.videoProfile") }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field
                  ref="name"
                  :label="$t('App.botName') + '*'"
                  v-model="Bot.name"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.botUsername') + '*'"
                  ref="username"
                  v-model="Bot.username"
                  type="username"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.botKey') + '*'"
                  ref="property_key"
                  v-model="Bot.property_key"
                  type="property_key"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <small>{{ $t("Sys.requireMsg") }}</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="close">{{
            $t("Sys.close")
          }}</v-btn>
          <v-btn color="blue darken-1" flat @click="createOrUpdateVideo">{{
            $t("Sys.save")
          }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      search: "",
      show: "",
      dialog: false,
      isCreate: false,
      roles: [],
      rules: {
        required: value => !!value || "Required."
      },
      Bot: {
        name: "",
        username: "",
        property_key: "",
      },
      addBot: {

      },
      desserts: []
    };
  },
  computed: {
    headers() {
      return [
        {
          text: "ID",
          align: "center",
          value: "id"
        },
        { text: this.$t("App.groupTitle"), value: "title", align: "center" },
        { text: this.$t("App.groupChatId"), value: "chat_id", align: "center" },
        {
          text: this.$t("Sys.createTime"),
          value: "create_time",
          align: "center"
        },
        {
          text: this.$t("Sys.updateTime"),
          value: "update_time",
          align: "center"
        },
        { text: this.$t("App.groupStatus"), value: "status", align: "center" },

      ];
    }
  },
  methods: {
    init() {
      axios.all([this.$api.group.get(), this.$api.role.get()]).then(
        axios.spread((bots, roles) => {
          this.$data.desserts = bots.data.map(v => {
            v.status = !!v.status;
            return v;
          });
          this.$data.roles = roles.data;
        })
      );
    },
    setState(props) {
      let status = props.item.status ? 1 : 0;
      this.$api.bot.setState(props.item.id, status).then(() => {
        this.$notify.success("edit success", { timeout: 500 });
      });
    },
    editUser(props) {
      this.$api.bot.getBotById(props.item.id).then(data => {
        this.$data.Bot = data.data;
        this.$data.dialog = true;
      });
    },
    resetPwd(props) {
      this.$api.bot.resetPwd(props.item.id).then(() => {
        this.$notify.success("reset password success", { timeout: 500 });
      });
    },
    createOrUpdateVideo() {
      if (this.$data.isCreate) {
        let userInfo = Object.assign({}, this.$data.Bot, this.$data.addBot);
        this.$api.bot.createBot(userInfo).then(() => {
          this.$data.isCreate = false;
          this.init();
          this.$notify.success("create success", { timeout: 500 });
        });
      } else {

        this.$api.bot
          .editBot(this.$data.Bot.id, this.$data.Bot)
          .then(() => {
            this.init();
            this.$notify.success("edit success", { timeout: 500 });
          });
      }
      this.dialog = false;
    },
    createBot() {

      let form = ["name","username", "property_key"];
      Object.keys(this.$data.Bot).forEach(f => {

        if (0 <= form.indexOf(f)) {
          this.$refs[f].reset();
        }
      });

      this.$data.isCreate = true;
      this.$data.dialog = true;
    },
    close() {
      if (this.$data.isCreate) {
        this.$data.isCreate = false;
      }
      this.$data.dialog = false;
    }
  },
  created() {
    this.init();
  }
};
</script>
