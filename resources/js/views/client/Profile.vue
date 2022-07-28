<template>
    <Section title="Perfil" icon="person">
        <Stepper :steps="steps" :defaultStep="isRegular ? 0 : 1">
            <template #step-0>
                <ClientProfileFormPersonal/>
            </template>
            <template #step-1>
                <div class="d-flex flex-row justify-content-stretch">
                    <ClientProfileFormPayment1 @update="componentKey++"/>
                    <ClientProfileFormPayment2 v-if="user.plan_period !== 'free'" :key="componentKey"/>
                </div>
            </template>
        </Stepper>
    </Section>
</template>

<script>
import { storeToRefs } from 'pinia';
import { useCurrentUserStore} from '../../stores/client';

export default {
    setup() {
        const currentUserStore = useCurrentUserStore();
        currentUserStore.refresh();
        const {isRegular, isPastTestPeriod, user} = storeToRefs(currentUserStore);

        return {
            isRegular,
            isPastTestPeriod,
            user
        }
    },
    methods: {
        forceRerender() {
            this.componentKey += 1;  
        }
    },
    data() {
        return {
            componentKey: 0
        }
    },
    created() {
        this.steps = ["Dados pessoais", "Plano e Pagamento"];

        if(!this.isRegular && this.isPastTestPeriod) {
            alert("Não identificamos o pagamento da sua assinatura da plataforma. Para retomar o acesso, escolha um dos métodos de pagamento disponíveis.\n\n"
                + "Desconsidere esta mensagem caso já tenha efetuado o pagamento da assinatura.");
        }
    },
}
</script>