import { Model as VueApiQueryModel } from 'vue-api-query'

// //================ Axios
import axios from 'axios'
import { Model } from 'vue-api-query'
Model.$http = axios

export default class BaseModel extends VueApiQueryModel {

    getParentClass(){
        return this.__proto__.__proto__;
    }

    // define a base url for a REST API
    baseURL () {
        return ''
    }

    // implement a default request method
    request (config) {
        return this.$http.request(config)
    }

    preparaRequest(request_config){

        if(request_config.url && request_config.url != this._fromResource){
            if( ! this._fromResource){
                this._from(request_config.url)
            }
            else {
                console.info('Depois de configurar uma vez não pode ser configurado de novo, tente o metodo reconfiguraRequest')
            }
        }

        return this;
    }

    reconfigurarRequest(method, url, data){
        return {
            method:method,
            url:url,
            data: Object.assign(this, data)
        }
    }

    executar(request){
        // this.limparThis();

        return this
                .request(request)
                .then(response => {
                    return  Object.assign(this, response.data)
                })
    }

    limparThis(){
        var props = Object.getOwnPropertyNames(this);
        delete props[props.indexOf('_fromResource')];
        for (var i = 0; i < props.length; i++) {
            delete this[props[i]];
        }
    }

    create(item) {

        let primaryKey = this.primaryKey();

        Object.assign(this, item)

        if( ! item.hasOwnProperty(primaryKey) || ! item[primaryKey]){
            delete this[primaryKey];
        }

    }

    createAndSave(item){
        if(item){
            this.limparThis()
        }
        else {
            item = this
        }

        this.create(item)
        return this.save()
    }

    createAndDelete(item){
        if(item){
            this.limparThis()
        }
        else {
            item = this
        }

        this.create(item)
        return this.delete()
    }

    preparaItem(item){
        this.limparThis();
        Object.assign(this, item)
        return this
    }

}
