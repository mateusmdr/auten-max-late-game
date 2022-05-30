<!DOCTYPE html>
<html>
    <head>
        <script src="https://sdk.mercadopago.com/js/v2"></script>
    </head>
<body>
 <form id="form-checkout" >
   <input type="text" name="cardNumber" id="form-checkout__cardNumber" />
   <input type="text" name="cardExpirationMonth" id="form-checkout__cardExpirationMonth" />
   <input type="text" name="cardExpirationYear" id="form-checkout__cardExpirationYear" />
   <input type="text" name="cardholderName" id="form-checkout__cardholderName"/>
   <input type="email" name="cardholderEmail" id="form-checkout__cardholderEmail"/>
   <input type="text" name="securityCode" id="form-checkout__securityCode" />
   <select name="issuer" id="form-checkout__issuer"></select>
   <select name="identificationType" id="form-checkout__identificationType"></select>
   <input type="text" name="identificationNumber" id="form-checkout__identificationNumber"/>
   <select name="installments" id="form-checkout__installments"></select>
   <button type="submit" id="form-checkout__submit">Pay</button>

   <progress value="0" class="progress-bar">loading...</progress>
 </form>

 <script src="https://sdk.mercadopago.com/js/v2"></script>
 <script>
    const mp = new MercadoPago("{{ env('MERCADO_PAGO_PK') }}", {
        locale: 'pt-BR'
    });

     const cardForm = mp.cardForm({
         amount: '100.5',
         autoMount: true,
         processingMode: 'aggregator',
         form: {
             id: 'form-checkout',
             cardholderName: {
                 id: 'form-checkout__cardholderName',
                 placeholder: 'Cardholder name',
             },
             cardholderEmail: {
                 id: 'form-checkout__cardholderEmail',
                 placeholder: 'Email',
             },
             cardNumber: {
                 id: 'form-checkout__cardNumber',
                 placeholder: 'Card number',
             },
              cardExpirationMonth: {
                 id: 'form-checkout__cardExpirationMonth',
                 placeholder: 'MM'
             },
             cardExpirationYear: {
                 id: 'form-checkout__cardExpirationYear',
                 placeholder: 'YYYY'
             },
             securityCode: {
                 id: 'form-checkout__securityCode',
                 placeholder: 'CVV',
             },
             installments: {
                 id: 'form-checkout__installments',
                 placeholder: 'Total installments'
             },
             identificationType: {
                 id: 'form-checkout__identificationType',
                 placeholder: 'Document type'
             },
             identificationNumber: {
                 id: 'form-checkout__identificationNumber',
                 placeholder: 'Document number'
             },
             issuer: {
                 id: 'form-checkout__issuer',
                 placeholder: 'Issuer'
             }
         },
         callbacks: {
            onFormMounted: error => {
                if (error) return console.warn('Form Mounted handling error: ', error)
                console.log('Form mounted')
            },
            onFormUnmounted: error => {
                if (error) return console.warn('Form Unmounted handling error: ', error)
                console.log('Form unmounted')
            },
            onIdentificationTypesReceived: (error, identificationTypes) => {
                if (error) return console.warn('identificationTypes handling error: ', error)
                console.log('Identification types available: ', identificationTypes)
            },
            onPaymentMethodsReceived: (error, paymentMethods) => {
                if (error) return console.warn('paymentMethods handling error: ', error)
                console.log('Payment Methods available: ', paymentMethods)
            },
            onIssuersReceived: (error, issuers) => {
                if (error) return console.warn('issuers handling error: ', error)
                console.log('Issuers available: ', issuers)
            },
            onInstallmentsReceived: (error, installments) => {
                if (error) return console.warn('installments handling error: ', error)
                console.log('Installments available: ', installments)
            },
            onCardTokenReceived: (error, token) => {
                if (error) return console.warn('Token handling error: ', error)
                console.log('Token available: ', token)
            },
            onSubmit: (event) => {
                event.preventDefault();
                const cardData = cardForm.getCardFormData();
                console.log('CardForm data available: ', cardData)
            },
            onFetching:(resource) => {
                console.log('Fetching resource: ', resource)

                // Animate progress bar
                const progressBar = document.querySelector('.progress-bar')
                progressBar.removeAttribute('value')

                return () => {
                    progressBar.setAttribute('value', '0')
                }
            },
        }
     })
 </script>
</body>
</html>