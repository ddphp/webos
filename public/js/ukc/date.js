define(['vue'], function (Vue) {
    Vue.component('ukc-date', {
        template: '\
        <div class="uk-form-row">\
            <label class="uk-form-label" v-once v-bind:for="id" v-text="dName"></label>\
            <div class="uk-form-controls">\
                <div class="uk-form-icon">\
                    <i class="uk-icon-calendar"></i>\
                    <input v-bind:id="id" v-bind:name="dName" class="uk-form-small uk-form-width-small" type="text"\
                           v-bind:class="[{\'uk-form-danger\':dErr}, dWidth ? \'uk-form-width-\'+dWidth : \'\']"\
                           v-bind:placeholder="placeholder ? placeholder : \'请输入\'+dName"\
                    data-uk-datepicker="{format:\'YYYY-MM-DD\',i18n:{months:[\'一月\',\'二月\',\'三月\',\'四月\',\'五月\',\'六月\',\'七月\',\'八月\',\'九月\',\'十月\',\'十一月\',\'十二月\'],weekdays:[\'日\',\'一\',\'二\',\'三\',\'四\',\'五\',\'六\']}}">\
                </div>\
            </div>\
        </div>\
        ',
        props: {
            dName: String,
            dErr: String,
            dWidth: {
                type: String,
                default: ''
            },
            value: String,
            id: String,
            placeholder: String
        },
        methods: {
            updateValue: function (value) {
                this.$emit('change', value)
            }
        }
    });
});

