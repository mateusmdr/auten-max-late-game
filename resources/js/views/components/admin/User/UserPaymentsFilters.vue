<template>
    <RadioChips
        :chips="paymentStatuses"
        v-model="inputs.paymentStatus"
    />
    <div class="input-container my-5">
        <div class="row">
            <div class="col-1">
                <DateInput v-model="inputs.date"/>
            </div>
            <div class="col-1">
                <TimeInput v-model="inputs.time"/>
            </div>
            <div class="col-2">
                <SearchInput
                    v-model="inputs.search"
                />
            </div>
        </div>
    </div>
</template>

<script>
import {format} from 'date-format-parse';

export default {
    emits: ['change'],
    created() {
        this.paymentStatuses = [
            {
                text:'Todos',
                hasIcon: false,
            },
            {
                text:'Mensal',
                color:'#B376F8',
            },
            {
                text:'Semestral',
                color:'#F5A847',
            },
            {
                text:'Anual',
                color:'#05F28E',
            },{
                text: 'Pendentes',
                color: '#EB4263'
            }
        ];
    },
    data() {
        return {
            inputs: {
                paymentStatus: 0,
                date: null,
                time: null,
                search: null,
            },
        }
    },
    watch: {
        inputs: {
            handler(before, now) {
                const newFilter = (payment) => {

                    let paymentStatusFilter = true;
                    switch(now.paymentStatus) {
                        case 1:
                            paymentStatusFilter = !payment.is_pending && payment.plan === 'Mensal';
                            break;
                        case 2:
                            paymentStatusFilter = !payment.is_pending && payment.plan === 'Semestral';
                            break;
                        case 3:
                            paymentStatusFilter = !payment.is_pending && payment.plan === 'Anual';
                            break;
                        case 4:
                            paymentStatusFilter = payment.is_pending;
                    }

                    const search = (payment.plan + payment.price.split(' ')[1] + payment.payment_method).toLowerCase();
                    return (
                        paymentStatusFilter &&
                        (now.search ? search.includes(now.search.toLowerCase()) : true) &&
                        (now.date ? payment.date === format(now.date, 'DD/MM/YYYY') : true) &&
                        (now.time ? payment.time === format(now.time, 'HH:mm') : true)
                    );
                };
                
                this.$emit('change',newFilter);
            },
            deep: true
        }
    },
}
</script>

<style>

</style>