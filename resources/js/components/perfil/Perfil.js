import Model from '@/models/base/Model'

export default class Auth extends Model {

    resource()
    {
        return `perfil`
    }

    mudarSenha(senha_atual, senha_nova, senha_nova_confirmacao){
        let item = {
            senha_atual: senha_atual,
            senha_nova: senha_nova,
            senha_nova_confirmation: senha_nova_confirmacao,
        }

        let request = this.reconfigurarRequest('POST', `mudar-senha`, item)
        return this.executar(request)
    }

}
