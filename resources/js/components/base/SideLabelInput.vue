<template>
    <div class="row">
        <div class="col-md-3 col-sm-12">
            <label class="w-100 text-left d-md-none d-lg-none d-sm-block d-xs-block">{{title}}</label>
            <label class="w-100 text-right d-none d-lg-block d-md-block d-sm-none d-xs-none">{{title}}</label>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="form-group">
                <input 
                    :value="value"
                    ref="boundInput"
                    :name="name"
                    :placeholder="customPlaceholder" 
                    type="text" 
                    :class="{'is-invalid': errorText}"
                    @input="$emit('input', $event.target.value)"
                    class="form-control"/>
                <div class="invalid-feedback">{{errorText}}</div>
            </div>
        </div>
    </div>
</template>
<script>
import {get} from 'lodash'
export default {
    props : [
        "title", "value", "name", "error", "placeholder"
    ],
    data() {
        return {
            errorText : this.error,
            customPlaceholder : this.placeholder ?? this.title
            
        }
    },
    methods : {
        get,
        bindInput(){
            this.$emit('input')
        }
    },
    watch : {
        error(newVal, oldVal){
            if(newVal !== oldVal) this.errorText = newVal;
        }
    }
}
</script>