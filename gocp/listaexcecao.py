import os

excecoes = [
'local/temp',
'.pst',
]

def get():
    for index, excecao in enumerate(excecoes):
        excecoes[index] = os.path.normpath(excecao)
    return excecoes
