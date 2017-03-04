define(['vue'], function (Vue) {
    Vue.component('ukc-input', {
        template: '\
        <div class="uk-form-row">\
            <label v-once v-bind:for="id" class="uk-form-label" v-text="dName"></label>\
            <div class="uk-form-controls">\
                <input v-bind:id="id" type="text" v-bind:placeholder="placeholder ? placeholder : \'请输入\'+dName"\
                       v-bind:class="[{\'uk-form-danger\':dErr}, dWidth ? \'uk-form-width-\'+dWidth : \'\']"\
                       v-bind:value="value"\
                       v-on:input="updateValue($event.target.value)"\
                >\
                <span class="uk-form-help-inline uk-text-danger" v-text="dErr"></span>\
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
                this.$emit('input', value)
            }
        }
    });
});
