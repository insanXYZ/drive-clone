<template>
  <auth>
    <div
      class="w-2/3 h-2/3 bg-white grid grid-cols-2 justify-between rounded-md"
    >
      <Banner
        header="Register"
        text=" have account? "
        to="/login"
        anch="Login"
      ></Banner>
      <Form button="Register">
        <inputLabel label="Username" type="text" />
        <inputLabel label="Email" type="text" />
        <inputLabel label="Password" type="password" />
      </Form>
    </div>
  </auth>
</template>
<script>
import auth from "./templates/auth.vue";
import inputLabel from "../components/auth/inputLabel.vue";
import Form from "../components/auth/Form.vue";
import Banner from "../components/auth/Banner.vue";

export default {
  components: {
    auth,
    inputLabel,
    Form,
    Banner,
  },
};
</script>
