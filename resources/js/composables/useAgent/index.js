import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useAgent() {
    const url = "/agent";

    const state = reactive({
        agents: {},
        isLoadingAgent: true,
    });

    const getAgents = async () => {
        api.get(url).then((e) => {
            state.agents = e.data.data;
            state.isLoadingAgent = false;
        });
    };

    return {
        ...toRefs(state),
        getAgents,
    };
}
