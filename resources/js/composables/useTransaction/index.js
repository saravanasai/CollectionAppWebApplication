import { reactive, toRefs } from "vue";

import api from "../../config";

export default function useTransaction() {
    const url = "/transaction";

    const state = reactive({
        transactions: {},
        customertransactions: {},
        customerTransactionsTotal: {},
        isLoadingTransaction: true,
    });

    const getAllTransactions = async () => {
        state.isLoadingTransaction = true;
        api.get(url).then((e) => {
            state.transactions = e.data.data;
            state.isLoadingTransaction = false;
        });
    };

    const getSingleCustomerTransaction = async (id) => {
        state.isLoadingTransaction = true;
        api.get(url + "/" + id).then((e) => {
            state.customertransactions = e.data.data;
            state.customerTransactionsTotal = e.data.total;
            state.isLoadingTransaction = false;
        });
    };

    return {
        ...toRefs(state),
        getAllTransactions,
        getSingleCustomerTransaction,
    };
}
