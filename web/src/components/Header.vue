<template>
  <v-toolbar clipped-left absolute app>
    <v-toolbar-side-icon
      v-if="primaryDrawer.type"
      @click.stop="setModel"
    ></v-toolbar-side-icon>
    <v-toolbar-title class="headline text-uppercase">
      <span>发车后台</span>
      <span class="font-weight-light">{{ $t("Sys.title") }}</span>
    </v-toolbar-title>
    <UserCenter
      :setDialog="dialog"
      @closeDialog="close"
      v-if="primaryDrawer.type"
    />
    <v-spacer></v-spacer>
    <!-- serach -->
    <v-text-field
      flat
      solo-inverted
      hide-details
      prepend-inner-icon="search"
      :label="$t('Sys.search')"
      class="hidden-sm-and-down"
      v-if="primaryDrawer.type"
    ></v-text-field>
    <!-- theme -->
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" flat>
          {{ $t("Sys.theme") }}
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in themeItems"
          :key="index"
          @click="theme(index)"
        >
          <v-list-tile-title>{{ $t(item.title) }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
    <!-- language -->
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" flat>
          {{ $t("Sys.lang") }}
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in langItems"
          :key="index"
          @click="lang(index)"
        >
          <v-list-tile-title>{{ item.title }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
    <!-- user information -->
    <v-menu offset-y v-if="primaryDrawer.type">
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on" flat large>
          <v-avatar size="32px" tile>
            <img
              src="https://cdn.vuetifyjs.com/images/logos/logo.svg"
              alt="Vuetify"
            />
          </v-avatar>
        </v-btn>
      </template>
      <v-list>
        <v-list-tile
          v-for="(item, index) in userItems"
          :key="index"
          @click="user(index)"
        >
          <v-list-tile-title>{{ $t(item.title) }}</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>


  </v-toolbar>
</template>
<script>
import Cache from "@/libs/cache";
import UserCenter from "@/components/UserCenter";

export default {
  name: "Header",
  components: { UserCenter },
  data() {
    return {
      themeItems: [{ title: "Sys.dark" }, { title: "Sys.light" }],
      langItems: [{ title: "简体中文" }, { title: "English" }],
      userItems: [{ title: "Sys.personalCenter" }, { title: "Sys.logout" }],
      primaryDrawer: {
        type: true,
        model: true
      },
      dialog: false
    };
  },
  methods: {
    theme(index) {
      let status = index === 0 ? true : false;
      this.$store.commit("changeTheme", status);
    },
    lang(index) {
      let locale = "";
      index === 1 ? (locale = "en") : (locale = "zh");
      this.$i18n.locale = locale;
      Cache.set("lang", locale);
    },
    setModel() {
      this.$data.primaryDrawer.model = !this.$data.primaryDrawer.model;
      this.$emit("changeDrawerModel", this.$data.primaryDrawer.model);
    },
    user(index) {
      if (index === 0) {
        return (this.$data.dialog = true);
      } else {
        this.$api.account.logout().then(() => {
          this.$store.commit("delToken");
          this.$router.push({ path: "/login" });
        });
      }
    },
    close() {
      this.$data.dialog = false;
    }
  },
  props: {
    primaryDrawerType: {
      default: true,
      type: Boolean
    },
    primaryDrawerModel: {
      default: true,
      type: Boolean
    }
  },
  created() {
    this.$data.primaryDrawer.type = this.$props.primaryDrawerType;
  },
  watch: {
    // watch parent component
    primaryDrawerModel: function(val) {
      this.$data.primaryDrawer.model = val;
    }
  }
};
</script>

<style>
.github-corner {
  padding: 10px;
}
</style>
