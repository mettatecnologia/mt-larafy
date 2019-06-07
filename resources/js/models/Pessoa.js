import Model from './base/Model'

export default class Pessoa extends Model {

    resource()
    {
        return 'pessoas'
    }

    alterarAcesso(item){
        let request = this.reconfigurarRequest('POST', 'pessoas/alterar-acesso', item)
        return this.executar(request)
    }



}
