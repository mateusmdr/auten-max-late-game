<template>
    <div class="instructions-box">
        <label>Para gerenciar o tempo que a notificação fica na sua tela, vá em: Configurações > Facilidade de acesso > Tela  > Simplificar e personalizar o Windows.</label>
        <img src="@images/instructions/5.png"/>
        <img src="@images/instructions/6.png"/>
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