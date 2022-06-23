import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useFreeCustomer() {
    const url = "free/customer";

    const state = reactive({
        customers: {},
        customer: {},
        isLoadingCustomer: true,
    });

    const getCustomers = async (
        key = "",
        location = 0,
        agent = 0,
        plan = 0,
        amount = 0
    ) => {
        state.isLoadingCustomer = true;

        let dynamicUrl =
            url +
            "?searchKey=" +
            key +
            "&location=" +
            location +
            "&agent=" +
            agent +
            "&plan=" +
            plan +
            "&amount=" +
            amount;

        api.get(dynamicUrl).then((e) => {
            state.customers = e.data.data;
            state.isLoadingCustomer = false;
        });
    };

    const getCustomer = async (id) => {
        state.isLoadingCustomer = true;
        api.get(url + "/" + id).then((e) => {
            state.customer = e.data.data;
            state.isLoadingCustomer = false;
        });
    };

    const addCustomer = (data) => {
        return api.post(url, data);
    };

    const updateCustomer = (id) => {
        let data = {
            f_username: state.customer.firstName,
            s_username: state.customer.secondName,
            primary_phone: state.customer.primaryPhone,
            secondary_phone: state.customer.secondaryPhone,
            location_id: state.customer.locationId,
            refered_agent_id: state.customer.agentId,
        };

        return api.put(url + "/" + id, data);
    };

    return {
        ...toRefs(state),
        getCustomers,
        getCustomer,
        addCustomer,
        updateCustomer,
    };
}
