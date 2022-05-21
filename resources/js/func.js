export const func = {
    toLocal: (date) => {
        return new Date(date.getTime() - date.getTimezoneOffset()*60*1000);
    },
    toUTC: (date) => {
        return new Date(date.getTime() + date.getTimezoneOffset()*60*1000);
    },
}