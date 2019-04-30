<template>
  <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
    <template v-slot:activator="{ on }">
      <v-btn flat icon color="accent" v-on="on">
        <v-icon>info</v-icon>
      </v-btn>
    </template>

    <v-card>
      <div>
        <v-toolbar color="primary" dark tabs>
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>

          <v-toolbar-title>Settings</v-toolbar-title>

          <template v-slot:extension>
            <v-tabs
              v-model="tab"
              color="primary"
              slider-color="accent"
            >
              <v-tab key="0" href="#tab-0">メンバー</v-tab>
              <v-tab key="1" href="#tab-1">参加していないメンバー</v-tab>
              <v-tab key="2" href="#tab-2">Settings</v-tab>
            </v-tabs>
          </template>

        </v-toolbar>

        <v-tabs-items v-model="tab">
          <v-tab-item key="0" value="tab-0">
            <joined-user-tab :users="joinedUsers"></joined-user-tab>
          </v-tab-item>

          <v-tab-item key="1" value="tab-1">
            <v-card flat>
              <not-joined-user-tab :users="notJoinedUsers"></not-joined-user-tab>
            </v-card>
          </v-tab-item>

          <v-tab-item key="2" value="tab-2">
            <v-card flat>
              <setting-tab :sub-team="subTeam"></setting-tab>
            </v-card>
          </v-tab-item>

        </v-tabs-items>
      </div>

    </v-card>

  </v-dialog>
</template>

<script>
  import JoinedUserTab from './infoModal/JoinedUserTab';
  import NotJoinedUserTab from './infoModal/NotJoinedUserTab';
  import SettingTab from './infoModal/SettingTab';
  export default {
    props: ['subTeamId'],
    components: {
      'joined-user-tab': JoinedUserTab,
      'not-joined-user-tab': NotJoinedUserTab,
      'setting-tab': SettingTab,
    },
    data() {
      return {
        dialog: false,
        panel: [true, false],
        tab: 'tab-0',
        joinedUsers: null,
        notJoinedUsers: null,
        subTeam: null,
      }
    },
    methods: {
      fetchParams: function () {
        axios.get(`/api/v1/sub-teams/${this.subTeamId}/info-modals`).then(res => {
          this.joinedUsers = res.data.joinedUsers;
          this.notJoinedUsers = res.data.notJoinedUsers;
          this.subTeam = res.data.subTeam;
        }).catch(e => {
        });
      }
    },
    mounted() {
      this.fetchParams();
    }
  }
</script>