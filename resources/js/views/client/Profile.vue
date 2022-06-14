<template>
    <Section title="Perfil" icon="person">
        <Stepper :steps="steps" :defaultStep="isRegular ? 0 : 1">
            <template #step-0>
                <ClientProfileFormPersonal/>
            </template>
            <template #step-1>
                <div class="d-flex flex-row justify-content-stretch">
                    <ClientProfileFormPayment1/>
                    <ClientProfileFormPayment2 v-if="user.plan_period !== 'free'"/>
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
        const {isRegular, user} = storeToRefs(currentUserStore);

        return {
            isRegular,
            user
        }
    },
    created() {
        this.steps = ["Dados pessoais", "Plano e Pagamento"];

        this.isRegular = this.user.isRegular;
    },
}
</script>