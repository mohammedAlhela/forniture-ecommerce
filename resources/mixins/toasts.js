

export default {
  methods: {
    fireSuccessToast: (message) => {
        Toast.fire({
            icon: "success",
            title: message ,
            timer: 2000,

        });
    },

    fireErrorToast: (message = 'Obs something went error on the server' ) => {
        Toast.fire({
            icon: "error",
            title: message,
            timer: 2000,

        });
    },

    fireWarningToast: (message = 'Obs something went error on the server') => {
        Toast.fire({
            icon: "warning",
            title: message ,
             timer: 2000,
        });
    },


  },
}
