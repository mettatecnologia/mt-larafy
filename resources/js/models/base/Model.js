import BaseModel from './BaseModel'// import { Model as BaseModel } from 'vue-api-query'

export default class Model extends BaseModel {

    session(key, valor_default){
        let request = this.reconfigurarRequest('POST', 'session/get-session', {key:key, default:valor_default})
        return this.executar(request)
    }

}
