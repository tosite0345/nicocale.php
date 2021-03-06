<template>
  <v-card>
    <v-card-title class="headline primary white--text" primary-title color="primary">
      {{ date | day }}
      <v-spacer></v-spacer>
      <v-btn dark icon @click="$emit('closeModal')" v-if="closeButton != false">
        <v-icon>close</v-icon>
      </v-btn>
    </v-card-title>

    <v-card-text>
      <p class="display-4 text-xs-center ma-0">
        <!-- TODO: set="charset" -->
        <emoji :emoji="emotion.emoji" :size="64"></emoji>
      </p>

      <div class="text-xs-center">
        <template v-for="emoji in oftenUseEmoji">

          <v-btn flat @click="selectEmoji(emoji)" style="height: 54px; min-width: 0;">
            <emoji :emoji="emoji" :size="32"></emoji>
          </v-btn>
        </template>
        <v-btn flat icon @click="picker = !picker">
          <v-icon>more_vert</v-icon>
        </v-btn>

        <v-fade-transition>
          <emoji-picker
            v-show="picker"
            :i18n="pickerI18n"
            :showSkinTones="false"
            title="NicoCale"
            @select="selectEmoji"
          ></emoji-picker>
        </v-fade-transition>

        <v-text-field
          v-model="emotion.status_text"
          :counter="100"
          label="ひとこと"
        ></v-text-field>

        <v-expansion-panel class="elevation-0">
          <v-expansion-panel-content>
            <div slot="header">メモを追加する</div>
            <v-card>
              <v-card-text class="text-xs-center pa-0">
                <v-textarea
                  v-model="emotion.memo"
                  :counter="100"
                  label="メモ"
                ></v-textarea>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>

      </div>

    </v-card-text>

    <v-divider></v-divider>

    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="good" outline :loading="loading" @click="save(score['good'])">いい感じ</v-btn>
      <v-btn color="soso" outline :loading="loading" @click="save(score['soso'])">まあまあ</v-btn>
      <v-btn color="bad"  outline :loading="loading" @click="save(score['bad'])">よくない</v-btn>
    </v-card-actions>
  </v-card>
</template>

<style scoped>
  .emoji-mart {
    width: 100% !important;
  }
</style>

<script>
  export default {
    props: ['teamId', 'date', 'emotion', 'teamUser', 'closeButton', 'loading'],
    data() {
      return {
        picker: false,
        defaultEmotion: {
          emoji: ":bust_in_silhouette:",
          status_text: '',
          memo: ''
        },
        pickerI18n: {
          search: '検索',
          notfound: '絵文字が見つかりませんでした',
          categories: {
            search: '検索結果',
            recent: 'よく使う絵文字',
            people: '人',
            nature: '自然',
            foods: 'フード＆ドリンク',
            activity: 'アクティビティ',
            places: 'トラベル＆場所',
            objects: 'オブジェクト',
            symbols: '記号',
            flags: '旗',
            custom: 'カスタム',
          }
        },
        oftenUseEmoji: [
          {
            colons: ":grin:",
            emoticons: [],
            id: "grin",
            name: "Grinning Face with Smiling Eyes",
            native: "😁",
            skin: null,
            unified: "1f601",
          },
          {
            colons: ":slightly_smiling_face:",
            emoticons: [
              ":)",
              "(:",
              ":-)",
            ],
            id: "slightly_smiling_face",
            name: "Slightly Smiling Face",
            native: "🙂",
            skin: null,
            unified: "1f642",
          },
          {
            colons: ":disappointed_relieved:",
            emoticons: [],
            id: "disappointed_relieved",
            name: "Disappointed but Relieved Face",
            native: "😥",
            skin: null,
            unified: "1f625",
          },
        ],
        score: {
          good: 1,
          soso: 2,
          bad: 3,
        },
      }
    },
    filters: {
      day: function (date) {
        return dayjs(date).format('M/D (ddd)');
      }
    },
    methods: {
      save: function (score) {
        if (this.emotion.hasOwnProperty('id')) {
          let e = this.emotion;
          let params = { emoji: e.emoji, score: score, status_text: e.status_text, memo: e.memo };
          this.$emit('updateEmotion', e.id, params);
        } else {
          let me = this.teamUser;
          let e = this.emotion;
          let team_user_id = (!me.team_user_id) ? me.id : me.team_user_id;
          let params = {
            team_id: me.team_id,
            team_user_id: team_user_id,
            emoji: e.emoji,
            score: score,
            status_text: e.status_text,
            memo: e.memo,
            entered_on: this.date,
          };
          this.$emit('createEmotion', params);
        }
      },
      selectEmoji: function (emoji) {
        this.emotion.emoji = emoji.colons;
      },
    },
  }
</script>