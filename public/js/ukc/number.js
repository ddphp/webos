define(['vue'], function (Vue) {
    Vue.component('ukc-number', {
        template:'\
<div class="uk-form-row">\
    <label v-bind:for="id" class="uk-form-label" v-text="dName"></label>\
    <div class="uk-form-controls">\
        <input v-bind:id="id" type="number" v-bind:min="min" v-bind:max="max" \
               v-bind:class="[{\'uk-form-danger\':dErr}, dWidth ? \'uk-form-width-\'+dWidth : \'\']"\
               v-bind:value="value"\
               v-on:input="updateValue($event.target.value)"\
        >\
        <span class="uk-form-help-inline uk-text-danger" v-text="dErr"></span>\
    </div>\
</div>\
        ',
        props: {
            id: String,
            min: String,
            max: {
                type: String,
                default: ''
            },
            value: String,
            dName: String,
            dWidth: String,
            dErr: String
        },
        methods: {
            updateValue: function (value) {
                this.$emit('input', value)
            }
        }
    });
});
