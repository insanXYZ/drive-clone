<template>
  <auth>
    <div
      class="w-2/3 h-[430px] bg-white grid grid-cols-2 justify-between rounded-md"
    >
      <Form @submit="store" button="Login">
        <div
          v-if="unauth"
          class="bg-blue-200 text-center py-1 text-white rounded-sm"
        >
          email and password is not valid
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
      <Banner
        header="Login"
        text="Don't have account? "
        to="/register"
        anch="Register"
      ></Banner>
    </div>
  </auth>
</template>
<script>
import auth from "./templates/auth.vue";
import inputLabel from "../components/auth/inputLabel.vue";
import Form from "../components/auth/Form.vue";
import Banner from "../components/auth/Banner.vue";
import validator from "validator";
import login from "../methods/auth/login";
import Cookies from "js-cookie";

export default {
  components: {
    auth,
    inputLabel,
    Form,
    Banner,
  },
  data() {
    return {
      email: "",
      errorEmail: false,
      errorEmailMessage: "Is not email valid",
      password: "",
      errorPassword: false,
      errorPasswordMessage: "Min password length is 8 character",
      unauth: false,
    };
  },
  methods: {
    validator() {
      let check = true;

      if (!validator.isEmail(this.email)) {
        this.errorEmail = true;
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

      if (check) {
        this.errorEmail = false;
        this.errorPassword = false;
      }
      return check;
    },
    store() {
      this.unauth = false;
      if (this.validator()) {
        login(this.email, this.password)
          .then((response) => {
            if (response.data.success == true) {
              Cookies.set("username",response.data.username);
              Cookies.set("token", response.data.token);
              this.$router.push("/");
            }
          })
          .catch((error) => {
            this.unauth = true;
          });
      }
    },
  },
};
</script>
