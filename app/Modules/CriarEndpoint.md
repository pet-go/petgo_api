# Passos para construção de endpoints por seu tipo
- Criar um repositório para cada endpoint.
- Criar uma interface para cada repositório.
- Criar uma collection para cada modelo.
- Criar uma classe de serviço para todos os repositórios.
- Criar uma controller para estender a controller base.

# Criando Repositórios
A camada onde será trabalhada a lógica é a de repositório. Como a lógica é muito semelhante para muitas models, será necessário basicamente inserir a crud que contém toda a lógica. As classes restantes operam do mesmo jeito.

## Repository - Buscar
- Aplicar a collection.
- Aplicar CrudRepositoryTrait

### Exemplo - Buscar
```php
class BuscarExemploRepository implements BuscarExemploContract
{
    use CrudRepositoryTrait;

    /** @var $resourceCollection */
    protected mixed $resourceCollection = ExemploCollection::class;
}
```
## Repository - Cadastrar
- Aplicar a collection.
- Aplicar CrudRepositoryTrait
- Criar/Aplicar vaidation

### Exemplo - Cadastrar
```php
class CadastrarExemploRepository implements CadastrarExemploContract
{
    use CrudRepositoryTrait;

    /** @var $resourceCollection */
    protected mixed $resourceCollection = ExemploCollection::class;
    protected mixed $validations = ExemploValidation::class;
}
```

## Repository - Exibir
- Aplicar Collection
- Aplicar CrudRepository

### Exemplo - Exibir
```php
class ExibirExemploRepository implements ExibirExemploContract
{
    use CrudRepositoryTrait;

    /** @var $resourceCollection */
    protected mixed $resourceCollection = ExemploCollection::class;
}
```

## Repository - Atualizar
- Aplicar a collection.
- Aplicar CrudRepositoryTrait
- Criar/Aplicar vaidation

### Exemplo - Atualizar
```php
class AtualizarExemploRepository implements AtualizarExemploContract
{
    use CrudRepositoryTrait;

    /** @var $resourceCollection */
    protected mixed $resourceCollection = ExemploCollection::class;
    protected mixed $validations = ExemploValidation::class;
}
```

## Repository - Remover
- Aplicar Collection
- Aplicar CrudRepository

### Exemplo - Remover
```php
class RemoverExemploRepository implements RemoverExemploContract
{
    use CrudRepositoryTrait;

    /** @var $resourceCollection */
    protected mixed $resourceCollection = ExemploCollection::class;
}
```

Obs: Após criar um repositório e a interface, lembrar de aplicar o bind deles em RepositoryProvider.

# Criando classe de serviços
Após desenvolver os repositórios, é necessário vinculá-los dentro da classe de serviço para posteriormente serem aplicados na classe controller.

## ExemploService
- Criar uma pipeline para pesquisa
- Aplicar CrudServiceTrait
- Aplicar todos os repositórios que serão utilizados dentro do contrutor.

### Exemplo - ExemploService
```php
class ExemploService
{
    use CrudServiceTrait;

    /** @var $pesquisaPipeline */
    protected mixed $pesquisaPipeline = PesquisarExemplo::class;

    public function __construct(
        private readonly CadastrarExemploRepository $cadastrarRepository,
        private readonly BuscarExemploRepository $buscarRepository,
        private readonly ExibirExemploRepository $exibirRepository,
        private readonly AtualizarExemploRepository $atualizarRepository,
        private readonly RemoverExemploRepository $removerRepository
    ) {
    }
}
```
Obs: Após aplicar os repositórios, é necessário fazer o bind entre a classe de serviço e os repositórios, em ServiceContainerProvider

# Criando Controllers
Por último, mas não menos importante, é necessário criar a controller que suportará todos os serviços.

## ExemplosController
- Aplicar CrudControllerTrait
- Aplicar o serviço e a model, dentro do construtor.

### Exemplo - ExemplosController
```php
class ExemplosController
{
    use CrudControllerTrait;

    public function __construct(
        private readonly ExemploService $servico,
        private readonly Exemplo $modelo
    ) {
    }
}
```
# Adicionais
Se todas as classes tiverem sido criadas corretamente, basta invocar seus endpoints seguindo o exemplo já presente. Sobre a classe de pesquisa e validação, basta observa os exemplos já criados.