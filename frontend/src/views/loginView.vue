<template>
  <auth>
    <div
      class="w-2/3 h-[430px] bg-white grid grid-cols-2 justify-between rounded-md"
    >
      <Form @submit="store" button="Login">
        <inputLabel
          @input="(input) => (email = input)"
          label="Email"
          type="text"
        />
        <inputLabel
          @input="(input) => (password = input)"
          label="Password"
          type="password"
        />
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
      errorEmailMessage: "",
      password: "",
      errorPassword: false,
      errorPasswordMessage: "",
    };
  },
  methods: {
    validator(email, password) {
      check = true;

      if (!validator.isEmail(email)) {
        this.errorEmail = true;
        this.errorEmailMessage = "Is not email valid";
        check = false;
      }
      if (
        !validator.isLength(password, {
          min: 8,
        })
      ) {
        this.errorPassword = true;
        this.errorPasswordMessage = "Min password length is 8 character";
        check = false;
      }
      this.errorEmail = false;
      this.errorEmailMessage = "";
      this.errorPassword = false;
      this.errorPasswordMessage = "";

      return check;
    },
  },
};
</script>
