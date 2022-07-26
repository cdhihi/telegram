<template>
  <v-card>
    <v-toolbar flat height="64px">
      <v-toolbar-title>{{ $t("App.advertiseManager") }}</v-toolbar-title>
    </v-toolbar>
    <v-card-title>
      <v-btn color="primary" @click="createUser">{{
        $t("App.createAdvertise")
      }}</v-btn>
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
        <td class="text-xs-center">{{ props.item.name }}</td>
        <td class="text-xs-center">{{ props.item.link }}</td>
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
        <td class="text-xs-center">
          <a-tag color="#108ee9" @click="editUser(props)">{{
            $t("Sys.edit")
          }}</a-tag>
          <a-popconfirm
            placement="topLeft"
            :okText="$t('Sys.yes')"
            :cancelText="$t('Sys.no')"
            @confirm="resetPwd(props)"
          >
            <template slot="title">
              <p>{{ $t("Sys.resetPwdMsg") }}</p>
            </template>

          </a-popconfirm>
        </td>
      </template>
    </v-data-table>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card ref="user">
        <v-card-title>
          <span class="headline">{{ $t("App.advertiseProfile") }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12>
                <v-text-field
                  ref="name"
                  :label="$t('App.advertiseName') + '*'"
                  v-model="advertise.name"
                  :rules="[rules.required]"
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  :label="$t('App.advertiseLink') + '*'"
                  ref="link"
                  v-model="advertise.link"
                  type="link"
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
          <v-btn color="blue darken-1" flat @click="createOrUpdateAdvertise">{{
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
      advertise: {
        name: "",
        link: ""
      },
      addUser: {

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
        { text: this.$t("App.advertiseName"), value: "id", align: "center" },
        { text: this.$t("App.advertiseLink"), value: "name", align: "center" },
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
        { text: this.$t("App.advertiseStatus"), value: "link", align: "center" },
        { text: this.$t("Sys.operation"), sortable: false, align: "center" }

      ];
    }
  },
  methods: {
    init() {
      axios.all([this.$api.advertise.get(), this.$api.role.get()]).then(
        axios.spread((users, roles) => {
          this.$data.desserts = users.data.map(v => {
            v.status = !!v.status;
            return v;
          });
          this.$data.roles = roles.data;
        })
      );
    },
    setState(props) {
      let status = props.item.status ? 1 : 0;
      this.$api.advertise.setState(props.item.id, status).then(() => {
        this.$notify.success("edit success", { timeout: 500 });
      });
    },
    editUser(props) {
      this.$api.advertise.getAdvertiseById(props.item.id).then(data => {
        this.$data.advertise = data.data;
        this.$data.dialog = true;
      });
    },
    resetPwd(props) {
      this.$api.user.resetPwd(props.item.id).then(() => {
        this.$notify.success("reset password success", { timeout: 500 });
      });
    },
    createOrUpdateAdvertise() {

      if (this.$data.isCreate) {
        let userInfo = Object.assign({}, this.$data.advertise, this.$data.addUser);

        this.$api.advertise.createAdvertise(userInfo).then(() => {

          this.$data.isCreate = false;
          this.$api.advertise.get().then(data => {
            this.$data.desserts = data.data;
          });
          this.$notify.success("create success", { timeout: 500 });
        });
      } else {

        this.$api.advertise
          .editAdvertise(this.$data.advertise.id, this.$data.advertise)
          .then(() => {
            this.$api.advertise.get().then(data => {
              this.$data.desserts = data.data;
            });
            this.$notify.success("edit success", { timeout: 500 });
          });
      }
      this.dialog = false;
    },
    createUser() {

      let form = ["name", "link"];
      Object.keys(this.$data.advertise).forEach(f => {

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
