import { reactive, toRefs } from "vue";

import api from "../../config";

export default function usePlan() {
    const url = "/plan";

    const state = reactive({
        plans: {},
        isLoadingPlan: true,
    });

    const getPlan = async () => {
        api.get(url).then((e) => {
            state.plans = e.data.data;
            state.isLoadingPlan = false;
        });
    };

    const addPlan = async (data) => {
       return api.post(url,data)
    };

    return {
        ...toRefs(state),
        getPlan,
        addPlan
    };
}
