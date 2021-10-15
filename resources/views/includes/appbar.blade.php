<v-app-bar app color="white" flat>

        <v-tabs icons-and-text centered class=" menu-principal" color="grey darken-1"
                active-class="menu-custom-active" hide-slider centered>
                <div class="d-flex px-5 py-2 content-menu">
                        <v-tab class="menu-custom" v-for="link in links" :key="link.id" :to="link.ruta">

                                <v-icon color="grey" class="ma-0">
                                        @{{ link.icon }}
                                </v-icon>
                        </v-tab>
                </div>

        </v-tabs>

        <v-menu v-model="menuSelectAccount" offset-y>
                <template v-slot:activator="{ on, attrs }">
                        <div v-bind="attrs"
                        v-on="on" class="d-flex" style="align-items: center;     position: absolute;
    right: 0;">
                                 <v-avatar   color="grey darken-1 shrink" size="32">
                                <v-icon v-if="!accountSession" color="white">
                                        mdi-account
                                </v-icon>
                                <img v-else :src="accountSession.img" alt="">
                        </v-avatar>
                        <span v-if="accountSession" class="font-weight-bold ml-1">
                                @@{{accountSession.username}}

                                
                        </span>
                        <v-icon>
                                @{{menuSelectAccount ? 'mdi-menu-up' : 'mdi-menu-down'}}
                        </v-icon>
                        </div>
                       
                        
        
                </template>
                <v-list dense>
                  <v-list-item
                    v-for="(item, index) in session"
                    :key="index"
                    @click="selectAccount(item)"
                  >
                  <v-list-item-avatar>
                        <v-img :src="item.img"></v-img>
                      </v-list-item-avatar>
                      <v-list-item-content>

                    <v-list-item-title>@{{ item.name }}</v-list-item-title>
                    <v-list-item-subtitle> @@{{item.username}} </v-list-item-subtitle>

                      </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-menu>
       
</v-app-bar>