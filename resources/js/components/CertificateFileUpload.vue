<template>
  <div>
    <p>Upload Your Certificate File</p>
    <input type="file" @change="uploadFile" />
  </div>
</template>

<script>
export default {
  props: ["applicantUuid"],
  methods: {
    uploadFile(event) {
      let files = event.target.files || event.dataTransfer.files;
      if (!files.length) return;
      let certificate = files[0];
      let formData = new FormData();
      formData.append("uuid", this.applicantUuid);
      formData.append("certificate", certificate);
      axios
        .post(`${window.location.origin}/api/certificate`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(({ data }) => {
          window.location.reload();
        })
        .catch((e) => {
          console.log(e);
        });
    },
  },
};
</script>

<style>
</style>