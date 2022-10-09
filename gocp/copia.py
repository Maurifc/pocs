## Temp2.txt sendo copiado
import os
import shutil
import listaexcecao
from pathlib import Path

destino = 'c:\\teste_destino'
origem = 'c:\\teste'

#Carrega a lista exceção
listaExcecao = listaexcecao.get()

#Arquivos PSTs / OSTs
arqOutlook = []

#Funcoes:
def estaNaListaExcecao(caminho):
    for excecao in listaExcecao:
        if(excecao in caminho):
            return True
    return False

def apagarDestino():
    pasta = Path(destino)

    if(pasta.exists()):
        shutil.rmtree(destino)

def criarPastaDestino():
    os.mkdir(destino)

def removerPontoDoCaminho(caminhoRelativo, nomeArquivo):
    if(os.path.basename(caminhoRelativo) == '.'):
        return os.path.join('', nomeArquivo)

    return os.path.join(caminhoRelativo, nomeArquivo)

def copiarPastas(root, dirs, caminhoRelativo):
    for name in dirs:
        caminhoAtual = removerPontoDoCaminho(caminhoRelativo, name)

        #Verifica se a pasta atual não está na exceção
        if(estaNaListaExcecao(caminhoAtual)):
            print('! Pulando {}'.format(caminhoAtual))
            continue;

        # Copia
        caminhoDestinoCompleto = os.path.join(destino, caminhoAtual)
        os.makedirs(caminhoDestinoCompleto)
        print('+ Criando {0} no destino.'.format(caminhoDestinoCompleto))


def copiarArquivos(root, files, caminhoRelativo):
    for name in files:
        caminhoOrigem = os.path.join(root, name) #pasta + nome do arquivo

        #Caso root seja '.', limpa o campo caminho atual
        caminhoAtual = removerPontoDoCaminho(caminhoRelativo, name)

        #Verifica se a pasta atual não está na exceção
        if(estaNaListaExcecao(caminhoAtual)):
            print('! Pulando {}'.format(caminhoAtual))
            continue;

        #Verifica se é arquivo PSTs / OSTs
        if (('.pst' in caminhoOrigem) or ('.ost' in caminhoOrigem)):
            arqOutlook.append(caminhoOrigem)

        # Copia
        caminhoDestinoCompleto = os.path.join(destino, caminhoAtual)
        shutil.copy(caminhoOrigem, caminhoDestinoCompleto)
        print("+ Copiando {}.".format(caminhoOrigem))
        arqCopiado = True


def iniciarCopia():
    for root, dirs, files in os.walk(origem, topdown=True):
        caminhoRelativo = os.path.relpath(root)

        copiarPastas(root, dirs, caminhoRelativo)
        copiarArquivos(root, files, caminhoRelativo)

def mostrarArquivosPsts():
    print('\nPSTs | OSTs: ')

    if(len(arqOutlook) == 0):
        print('Nenhum encontrado')
    else:
        for arq in arqOutlook:
            print('- ' + arq)

#Main
apagarDestino()
criarPastaDestino()

os.chdir(origem)

iniciarCopia()

mostrarArquivosPsts()
