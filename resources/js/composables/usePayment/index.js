import { reactive, toRefs } from "vue";

import api from "../../config";

export default function usePayment() {
    const url = "/payment";

    const state = reactive({
        amount: {},
    });

    const pay = async (id) => {
        let data = {
            amount: state.amount,
        };

        return api.post(url + "/" + id, data);
    };

    return {
        ...toRefs(state),
        pay,
    };
}
