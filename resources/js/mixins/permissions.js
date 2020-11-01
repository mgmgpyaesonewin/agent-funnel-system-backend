export default {
  computed: {
    allowAssignUser() {
      return this.$root.auth_user.is_admin === 1;
    }
  }
};
