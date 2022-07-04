import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useAgent() {
    const url = "/agent";

    const state = reactive({
        agents: {},
        agent: {},
        isLoadingAgent: true,
    });

    const getAgents = async () => {
        api.get(url).then((e) => {
            state.agents = e.data.data;
            state.isLoadingAgent = false;
        });
    };

    const getAgent = async (id) => {
        api.get(url + "/" + id).then((e) => {
            state.agent = e.data.data;
            state.isLoadingAgent = false;
        });
    };

    const addAgent = (data) => {
        return api.post(url, data);
    };

    const updateAgent = async (id) => {
        let data = {
            agent_name: state.agent.agentName,
            agent_phone: state.agent.agentPhone,
            agent_location_id: state.agent.agentLocationId,
        };

        return api.put(url + "/" + id, data);
    };

    return {
        ...toRefs(state),
        getAgents,
        getAgent,
        updateAgent,
        addAgent,
    };
}
