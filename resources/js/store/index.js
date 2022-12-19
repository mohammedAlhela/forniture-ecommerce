import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);
import reports from "./moduels/reports";


export default new Vuex.Store({
    modules: {
        reports,
    },

    state() {
        return {
            loading: true,
        };
    },

    mutations: {
        closeLoader: (state) => {
            state.loading = false;
        },

        openLoader: (state) => {
            state.loading = true;
        },
    },

    getters: {
        formatedDate: (state, getters) => dateItem => {
            let dateValue = new Date(dateItem);
            let YearMonthDay =
            dateValue.getFullYear() +
                "-" +
                (dateValue.getMonth() + 1) +
                "-" +
                dateValue.getDate();

            let timestamp =
                YearMonthDay + " " + getters.TwelveHoursFormetedTime(dateValue);
            return timestamp;
        },

        TwelveHoursFormetedTime: state => item => {
            const dateValue = item;
            var hours = dateValue.getHours();
            var minutes = dateValue.getMinutes();
            var ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? "0" + minutes : minutes;
            var strTime = hours + ":" + minutes + " " + ampm;
            return strTime;
        },


        getUniqueArray: (state) => (records) => {
            let uniqueArray = [];
            let index = -1;

            records.forEach((record) => {
                index = uniqueArray.findIndex(function (item) {
                    return item.id == record.id;
                });

                if (index == -1) {
                    uniqueArray.push(record);
                }
            });

            return uniqueArray;
        },

        getPermissionsNames() {
            let permissions = [];
            window.User.permissions.forEach((permission) => {
                permissions.push(permission.name);
            });

            return permissions;
        },
    },
});
