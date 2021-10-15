<template>
  <v-container fluid fill-height class="pa-0">
    <v-row style="height: 100%" no-gutters>
      <v-col cols="12" sm="12" md="2"> </v-col>

      <v-col cols="12" sm="12" md="8">
        <v-sheet v-if="$root.accountSession" class="mx-auto" elevation="0">
          <v-slide-group
            v-model="model"
            class="pa-4"
            active-class="success"
            show-arrows
          >
            <v-slide-item
              v-for="(n, index) in 15"
              :key="index"
              v-slot="{ active, toggle }"
            >
              <v-card
                :color="active ? undefined : 'grey lighten-4'"
                class="ma-4"
                height="180"
                width="100"
                @click="toggle"
              >
                <v-img
                  v-if="index == 0"
                  height="120"
                  :src="$root.accountSession.img"
                >
                </v-img>
                <div class="content-btn-history">
                  <v-btn
                    dark
                    v-if="index == 0"
                    class="primary btn-add-history"
                    icon
                  >
                    <v-icon> mdi-plus </v-icon>
                  </v-btn>
                </div>

                <span
                  v-if="index == 0"
                  class="px-2 caption d-block text-center font-weight-bold"
                  style="bottom: 2px; position: absolute"
                  >Nueva Historia</span
                >

                <v-row class="fill-height" align="center" justify="center">
                  <v-scale-transition>
                    <v-icon
                      v-if="active"
                      color="white"
                      size="48"
                      v-text="'mdi-close-circle-outline'"
                    ></v-icon>
                  </v-scale-transition>
                </v-row>
              </v-card>
            </v-slide-item>
          </v-slide-group>
        </v-sheet>
        <v-card elevation="0">
          <v-card-title>
            <v-form style="width: 100%">
              <v-list-item>
                <v-list-item-avatar>
                  <v-img :src="$root.accountSession.img"></v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                  <v-list-item-title>
                    <v-textarea
                      hide-details
                      autofocus
                      dense
                      filled
                      rounded
                      placeholder="Qué tienes en mente?"
                      rows="3"
                      v-model="description"
                    >
                    </v-textarea
                  ></v-list-item-title>
                  <v-list-item-subtitle class="pt-2 d-flex">
                      <input
              type="file"
              multiple
              id="fileInput"
              ref="file"
              accept="image/png, image/jpeg, image/gif"
              maxlength="3"
              style="display: none"
              @change="onFileChange"
            />
                    <v-btn onclick="document.getElementById('fileInput').click()" rounded text class="text-capitalize" >
                       <v-icon color="primary" left>mdi-camera</v-icon> Foto</v-btn>
                    <v-btn rounded text class="text-capitalize"> <v-icon color="primary" left>mdi-video</v-icon> Video</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn depressed rounded dark class="primary text-capitalize" @click="guardarPost($root.accountSession.id)">Publicar</v-btn>
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-form>
          </v-card-title>
        </v-card>
      </v-col>

      <v-col cols="12" sm="12" md="2"> </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    preview_img: [],
    model: null,
    description: null,
    form_data: {
      image_list: [],
      }
  }),
  methods: {
    guardarPost(id){
      var params = {
        key1 : this.description,
        key2 : this.photo,
        key3 : this.video,
        key4 : id,
      }
      axios.post("/guardarPost",params)
      .then(res => {
        this.limpiarCampos();
        console.log(res)
      })
      .catch(err => {
        console.error(err); 
      })
    },
    limpiarCampos(){
      this.description = null;
    },
   onFileChange(event) {
     console.log(event);
      var input = event.target;
      var count = input.files.length;
      var index = 0;

      if (input.files) {
        while (count--) {

          var reader = new FileReader();

          reader.onload = (e) => {
            this.preview_img.push(e.target.result);
          };

          this.form_data.image_list.push(input.files[index]);

          reader.readAsDataURL(input.files[index]);
          // }
          index++;
        }
      }
    },
  },
};
</script>