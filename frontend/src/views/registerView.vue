<template>
  <auth>
    <div
      class="w-2/3 h-[430px] bg-white grid grid-cols-2 justify-between rounded-md"
    >
      <Banner
        header="Register"
        text=" have account? "
        to="/login"
        anch="Login"
      ></Banner>
      <Form @submit="register" button="Register">
        <inputLabel
          @input="(input) => (username = input)"
          label="Username"
          type="text"
        />
        <div class="text-sm italic font-light" v-if="errorUsername">
          {{ errorUsernameMessage }}
        </div>
        <inputLabel
          @input="(input) => (email = input)"
          label="Email"
          type="text"
        />
        <div class="text-sm italic font-light" v-if="errorEmail">
          {{ errorEmailMessage }}
        </div>

        <inputLabel
          @input="(input) => (password = input)"
          label="Password"
          type="password"
        />
        <div class="text-sm italic font-light" v-if="errorPassword">
          {{ errorPasswordMessage }}
        </div>
      </Form>
    </div>
  </auth>
</template>
<script>
import auth from "./templates/auth.vue";
import inputLabel from "../components/auth/inputLabel.vue";
import Form from "../components/auth/Form.vue";
import Banner from "../components/auth/Banner.vue";
import register from "../methods/auth/register";
import validator from "validator";

export default {
  data() {
    return {
      username: "",
      errorUsername: false,
      errorUsernameMessage: "Min username length is 3 character",
      email: "",
      errorEmail: false,
      errorEmailMessage: "Is not email valid",
      password: "",
      errorPassword: false,
      errorPasswordMessage: "Min password length is 8 character",
    };
  },
  methods: {
    validation() {
      let check = true;

      if (!validator.isEmail(this.email)) {
        this.errorEmail = true;
        check = false;
      }

      if (
        !validator.isLength(this.username, {
          min: 3,
        })
      ) {
        this.errorUsername = true;
        check = false;
      }

      if (
        !validator.isLength(this.password, {
          min: 8,
        })
      ) {
        this.errorPassword = true;
        check = false;
      }

      if (check === true) {
        this.errorEmail = false;
        this.errorEmailMessage = "";
        this.errorPassword = false;
        this.errorPasswordMessage = "";
        this.errorUsername = false;
        this.errorUsernameMessage = "";
      }

      return check;
    },
    register() {
      if (this.validation()) {
        register(this.username, this.email, this.password)
          .then((response) => {
            if (response.data.success == true) {
              this.$router.push("login");
            }
          })
          .catch((response) => {
            console.error("Connection to database is failed");
          });
      }
    },
  },
  components: {
    auth,
    inputLabel,
    Form,
    Banner,
  },
};
</script>
