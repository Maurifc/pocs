# Features

## Instalação
- Deploy fácil com Helm Chart oficial
- Aplicações podem ser configuradas aplicando um yaml com o Kubectl
- Ferramenta para exportar configurações do cluster

## Policiamento de estado:
-**Auto Sync**  
    Sempre que o ele detecta uma mudança no repositório, ele sincroniza com cluster automaticamente.

-**Self Heal**  
    Restaura a aplicação pro seu estado descrito no repositório casa haja intervenção manual no cluster.

-**Diff**  
    Se a sincronização automática estiver desativada, você consegue visualizar a diff entre o que está no repo e a aplicação.

-**History / Rollback**  
    Fácil visualização e restauração dos últimos deploys realizados.

## Outros:
- Cliente de linha de comando completo
- Permite criar projetos e limitar repositórios e clusters desse projeto
- Suporte à usuários com ACL