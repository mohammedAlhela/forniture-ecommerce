<template>
    <v-app>
        <v-main>
            <v-card flat>
                <v-card-text>
                    <v-form
                        class="form container"
                        @submit.prevent="save()"
                        enctype="multipart/form-data"
                        lazy-validation
                        ref="account"
                    >
                        <v-row>
                            <v-col cols="12 mt-5">
                                <span class="image-paragraph">
                                    Recomended image dimensions are 400 width
                                    and 400 height
                                </span>

                                <div class="upload-image-container">
                                    <div
                                        class="small-image-container category-image-container"
                                    >
                                        <img
                                            :src="getImage"
                                            class="small-image user-image"
                                        />
                                    </div>

                                    <div class="upload-container">
                                        <label
                                            for="category_image"
                                            class="custom-file-upload"
                                        >
                                            <v-icon class="icon">
                                                mdi-pencil
                                            </v-icon>
                                        </label>
                                        <input
                                            class="d-none"
                                            id="category_image"
                                            name="category_image_file"
                                            type="file"
                                            @change="imageSelected"
                                        />

                                        <span class="d-inline-block ml-2">
                                            <span v-html="getImageParagraph">
                                            </span>
                                        </span>

                                        <div
                                            class="clear-button"
                                            @click="clearImage()"
                                            v-if="image.preview"
                                        >
                                            <v-btn icon color="#645e5e">
                                                <v-icon
                                                    >mdi-cached</v-icon
                                                > </v-btn
                                            ><span class="paragraph">
                                                clear</span
                                            >
                                        </div>
                                    </div>
                                    <div class="clearing"></div>
                                </div>
                            </v-col>

                            <v-col cols="8" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Username </span>
                                    <v-icon class="validation-icon">
                                        mdi-star</v-icon
                                    >
                                </div>

                             

                                <v-text-field
                                    required
                                    :rules="errors.username"
                                    solo
                                    dense
                                    v-model="$authenticatedUser.username"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="8" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Email </span>
                                    <v-icon class="validation-icon">
                                        mdi-star</v-icon
                                    >
                                </div>

                                <v-text-field
                                    required
                                    :rules="errors.email"
                                    solo
                                    dense
                                    v-model="$authenticatedUser.email"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="8" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Password </span>
                                    <v-icon class="validation-icon">
                                        mdi-star</v-icon
                                    >
                                </div>

                                <v-text-field
                                    append-icon="mdi-eye"
                                    :rules="errors.password"
                                    solo
                                    dense
                                    v-model="editedItem.password"
                                    :type="passwordType"
                                    @click:append="
                                        changePasswordType('password')
                                    "
                                ></v-text-field>
                            </v-col>

                            <v-col cols="8" class="py-0 pt-3">
                                <div class="input-header">
                                    <span> Password confirmation </span>
                                    <v-icon class="validation-icon">
                                        mdi-star</v-icon
                                    >
                                </div>

                                <v-text-field
                                    append-icon="mdi-eye"
                                    solo
                                    dense
                                    :type="passwordConfirmationtype"
                                    @click:append="
                                        changePasswordType(
                                            'password-confirmation'
                                        )
                                    "
                                    v-model="
                                        editedItem.password_confirmation
                                    "
                                ></v-text-field>
                            </v-col>

                            <!-- actions button  -->
                            <v-col cols="12" class="buttons-holder">
                                <v-btn
                                    type="submit"
                                    :loading="buttonLoading"
                                    color="blue lighten-1"
                                    class="ma-2 white--text"
                                >
                                    Save Data
                                </v-btn>
                            </v-col>
                  
                            <!-- actions button  -->
                        </v-row>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-main>
    </v-app>
</template>

<script>

import toasts from "../../mixins/toasts";
export default {
    name : "Account",
    data() {
        return {
            passwordConfirmationtype: "password",
            passwordType: "password",
            editedItem: {
              password : "",
              password_confirmation : ""
            },
            defaultItem: {
                password : "",
              password_confirmation : ""
            },
            buttonLoading: false,
            errors: {},
            image: {
                file: "",
                name: "",
                preview: "",
            },

            defaultImage: {
                file: "",
                name: "",
                preview: "",
            },
        };
    },
    computed: {
        getImage() {
            return (
                this.image.preview ||
                this.$authenticatedUser.image ||
                "/images/users/user.webp"
            );
        },

        getImageParagraph() {
            if (this.errors.hasOwnProperty("image")) {
                return `<span class = "error-paragraph">  ${this.errors.image[0]}  </span> `;
            } else if (this.image.name) {
                return `<span class = "paragraph">  ${this.image.name}  </span> `;
            } else {
                return `<span class = "paragraph"> no image selected </span> `;
            }
        },

    },

    methods: {
        intializeSave() {
            this.errors = {};
            this.buttonLoading = true;
        },

        fillErrors(resErrors) {
            this.errors = resErrors;
            this.buttonLoading = false;
        },

        async save() {
            // this.$refs.account.validate();
            this.intializeSave();
            let accountData = new FormData();
            accountData.append("id", this.$authenticatedUser.id);
            accountData.append("image", this.image.file);
            accountData.append("username", this.$authenticatedUser.username);
            accountData.append("email", this.$authenticatedUser.email);
            accountData.append(
                "password",
                !this.editedItem.password
                    ? "no-password"
                    : this.editedItem.password
            );
            accountData.append(
                "password_confirmation",
                !this.editedItem.password_confirmation
                    ? "no-password"
                    : this.editedItem.password_confirmation
            );

            const Data = await axios
                .post(`account/write`, accountData)
                .catch((error) => {
                    this.fillErrors(error.response.data.errors);
                });

            if (Data) { 
                
                this.buttonLoading = false
                toasts.methods.fireSuccessToast('Account updated successfully');
               
                setTimeout(() => {
                    location.reload();
                } , 1500)
               

            
            }
        },

        imageSelected(element) {
            this.image.file = element.target.files[0];
            this.image.name = element.target.files[0].name;
            let reader = new FileReader();
            reader.readAsDataURL(this.image.file);
            reader.onload = (element) => {
                this.image.preview = element.target.result;
            };
        },

        clearImage() {
            this.image = Object.assign({}, this.defaultImage);
        },

        changePasswordType (type) { 
            if(  type == "password") { 
             this.passwordType == "password"  ?   this.passwordType = "text" :  this.passwordType = "password" ;
            }

            else { 
                this.passwordConfirmationtype == "password"  ?   this.passwordConfirmationtype = "text" :  this.passwordConfirmationtype = "password" ;
            }
        
          
        },

    },
};
</script>
