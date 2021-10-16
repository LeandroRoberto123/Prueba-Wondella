<template>
  <v-container fluid fill-height class="pa-0">
    <v-row style="height: 100%" no-gutters>
      <v-col cols="12" sm="12" md="2"> </v-col>

      <v-col cols="12" sm="12" md="8" class="pb-5">
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
                    <v-slide-group
                      class="px-0 py-2"
                      v-if="preview_img.length > 0"
                      active-class="success"
                      show-arrows
                    >
                      <v-slide-item
                        v-for="(img, indexImg) in preview_img"
                        :key="indexImg"
                      >
                        <v-hover v-slot="{ hover }">
                          <v-card outlined elevation="0" class="mx-2 d-flex">
                            <v-img
                              :gradient="
                                hover
                                  ? 'to top right, rgba(100,115,201,.33), rgba(25,32,72,.7)'
                                  : null
                              "
                              width="60"
                              :src="img"
                            ></v-img>
                            <v-icon
                              @click="deleteFileImg(indexImg)"
                              color="red"
                              size="18"
                              style="position: absolute; top: 0; right: 0"
                              v-if="hover"
                            >
                              mdi-delete-circle
                            </v-icon>
                          </v-card>
                        </v-hover>
                      </v-slide-item>
                    </v-slide-group>
                    <v-slide-group
                      class="px-0 py-2"
                      v-if="preview_video.length > 0"
                      active-class="success"
                      show-arrows
                    >
                      <v-slide-item
                        v-for="(video, indexVideo) in preview_video"
                        :key="indexVideo"
                      >
                        <v-hover v-slot="{ hover }">
                          <v-card outlined elevation="0" class="mx-2 d-flex">
                            <video width="250" controls>
                              <source :src="video" />
                              Your browser does not support HTML5 video.
                            </video>
                            <v-icon
                              @click="deleteFileVideo(indexVideo)"
                              color="red"
                              size="18"
                              style="position: absolute; top: 0; right: 0"
                              v-if="hover"
                            >
                              mdi-delete-circle
                            </v-icon>
                          </v-card>
                        </v-hover>
                      </v-slide-item>
                    </v-slide-group>
                    <v-textarea
                      hide-details
                      autofocus
                      dense
                      filled
                      rounded
                      placeholder="Qué tienes en mente?"
                      rows="3"
                      v-model="form_data.description"
                    >
                    </v-textarea
                  ></v-list-item-title>
                  <v-list-item-subtitle class="pt-2 d-flex">
                    <input
                      type="file"
                      multiple
                      id="fileInputImg"
                      ref="fileImg"
                      accept="image/png, image/jpeg, image/gif"
                      maxlength="3"
                      style="display: none"
                      @change="onFileChangeImg"
                    />
                    <input
                      type="file"
                      multiple
                      id="fileInputVideo"
                      accept="video/mp4"
                      ref="fileVideo"
                      maxlength="3"
                      style="display: none"
                      @change="onFileChangeVideo"
                    />
                    <v-btn
                      onclick="document.getElementById('fileInputImg').click()"
                      rounded
                      text
                      class="text-capitalize"
                    >
                      <v-icon color="primary" left>mdi-camera</v-icon>
                      Foto</v-btn
                    >
                    <v-btn
                      onclick="document.getElementById('fileInputVideo').click()"
                      rounded
                      text
                      class="text-capitalize"
                    >
                      <v-icon color="primary" left>mdi-video</v-icon>
                      Video</v-btn
                    >
                    <v-spacer></v-spacer>
                    <v-btn
                      :disabled="loadingSave"
                      :loading="loadingSave"
                      depressed
                      rounded
                      dark
                      class="primary text-capitalize"
                      @click="guardarPost($root.accountSession.id)"
                      >Publicar</v-btn
                    >
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-form>
          </v-card-title>

          <!-- {{ preview_img}} -->
        </v-card>

        <v-card
          elevation="0"
          class="mt-3"
          v-for="(post, indexPost) in items_post"
          :key="indexPost"
        >
          <v-card-title class="pb-0">
            <v-list-item class="pa-0">
              <v-list-item-avatar color="primary">
                <v-img :src="avatarUsuario(post.id_usuario)"></v-img>
              </v-list-item-avatar>

              <v-list-item-content>
                <v-list-item-title>{{
                  nameUsuario(post.id_usuario)
                }}</v-list-item-title>

                <v-list-item-subtitle
                  >@{{ userNameUsuario(post.id_usuario) }}
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card-title>
          <v-carousel
            v-if="post.multimedia.length > 0"
            height="300"
            hide-delimiters
            hide-delimiter-background
            show-arrows-on-hover
          >
            <v-carousel-item
              v-for="(multimedia, i) in post.multimedia"
              :key="i"
            >
              <v-sheet class="black" height="100%">
                <v-img
                  position="center center"
                  @click="openImg('/storage/' + multimedia.route_file)"
                  v-if="multimedia.type_file == 'imagen'"
                  :src="'/storage/' + multimedia.route_file"
                  alt=""
                />
                <video
                  class="d-block m-auto"
                  height="100%"
                  v-if="multimedia.type_file == 'video'"
                  controls
                >
                  <source :src="'/storage/' + multimedia.route_file" />
                  Your browser does not support HTML5 video.
                </video>
              </v-sheet>
            </v-carousel-item>
          </v-carousel>
          <v-card-text class="py-2" style="white-space: pre-line;">
            {{ post.description }}
          </v-card-text>
          <v-card-actions class="pt-0">
            <v-row no-gutters>
              <v-col>
                <v-btn text block class="text-capitalize">
                  <v-icon left> mdi-thumb-up </v-icon> Me gusta
                </v-btn>
              </v-col>
              <v-col>
                <v-btn text block class="text-capitalize">
                  <v-icon left> mdi-chat </v-icon> Comentar
                </v-btn>
              </v-col>
              <v-col>
                <v-btn text block class="text-capitalize">
                  <v-icon left> mdi-share </v-icon> Compartir
                </v-btn>
              </v-col>
            </v-row>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12" sm="12" md="2"> </v-col>
    </v-row>
    <v-dialog
      v-model="dialogImagen"
      persistent
      max-width="900px"
      transition="dialog-transition"
    >
      <v-img :src="imagenSrc">
        <v-btn
          @click="
            dialogImagen = false;
            imagenSrc = null;
          "
          icon
          class="grey darken-2 ma-1"
          dark
        >
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-img>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      loadingSave: false,
      dialogImagen: false,
      imagenSrc: null,
      items_post: [],
      preview_img: [],
      preview_video: [],
      model: null,
      form_data: {
        image_list: [],
        video_list: [],
        description: null,
      },
    };
  },
  created() {
    this.mostrarPost();
  },
  methods: {
    mostrarPost() {
      axios
        .post("/mostrarPost", {
          id_usuario: this.$root.accountSession.id,
        })
        .then((res) => {
          this.items_post = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
    guardarPost(id) {
      this.loadingSave = true;
      let formData = new FormData();
      if (this.form_data.image_list.length > 0) {
        this.form_data.image_list.forEach((file) => {
          formData.append("img[]", file);
        });
      }
      if (this.form_data.video_list.length > 0) {
        this.form_data.video_list.forEach((file) => {
          formData.append("video[]", file);
        });
      }
      formData.append("description", this.form_data.description);
      formData.append("id_usuario", this.$root.accountSession.id);

      axios
        .post("/guardarPost", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.limpiarCampos();
          // console.log(res);
          this.loadingSave = false;
          this.mostrarPost();
        })
        .catch((err) => {
          console.error(err);
          this.loadingSave = false;
        });
    },
    limpiarCampos() {
      // this.description = null;}
      this.form_data.image_list = [];
      this.form_data.video_list = [];
      this.form_data.description = null;
      this.preview_img = [];
      this.preview_video = [];
    },
    onFileChangeImg(event) {
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
      document.getElementById("fileInputImg").value = "";
    },
    onFileChangeVideo(event) {
      var input = event.target;
      var count = input.files.length;
      var index = 0;

      if (input.files) {
        while (count--) {
          var reader = new FileReader();

          reader.onload = (e) => {
            this.preview_video.push(e.target.result);
          };

          this.form_data.video_list.push(input.files[index]);

          reader.readAsDataURL(input.files[index]);
          // }
          index++;
        }
      }
      document.getElementById("fileInputVideo").value = "";
    },
    deleteFileImg(index) {
      this.preview_img.splice(index, 1);
      this.form_data.image_list.splice(index, 1);
    },
    deleteFileVideo(index) {
      this.preview_video.splice(index, 1);
      this.form_data.video_list.splice(index, 1);
    },
    avatarUsuario(id_usuario) {
      let filter = this.$root.session.find(
        (session) => session.id == id_usuario
      );
      return filter.img;
    },
    nameUsuario(id_usuario) {
      let filter = this.$root.session.find(
        (session) => session.id == id_usuario
      );
      return filter.name;
    },
    userNameUsuario(id_usuario) {
      let filter = this.$root.session.find(
        (session) => session.id == id_usuario
      );
      return filter.username;
    },
    openImg(img) {
      this.dialogImagen = true;
      this.imagenSrc = img;
    },
  },
};
</script>