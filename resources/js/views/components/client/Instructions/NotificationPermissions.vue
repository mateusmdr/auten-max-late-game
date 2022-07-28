<template>
    <div class="instructions-box">
        <label>Você pode permitir que a Max Late Game te notifique em: Configurações > Sistema > Assistente de foco  > Personalizar lista de prioridades.</label>
        <img src="@images/instructions/1.png"/>
        <img src="@images/instructions/2.png"/>
        <img src="@images/instructions/3.png"/>
        <label>Não esqueça de permitir, também, as notificações no seu navegador.</label>
        <img src="@images/instructions/4.png"/>
    </div>
</template>

<style scoped lang="scss">
    .instructions-box {
        background-color: #232323;
        border-radius: 8px;
        padding: 24px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        flex-direction: column;
        img {
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: 600;
            font-size: 16px;
            color: #7F8896;
            margin-bottom: 1rem;
        }
    }
</style>