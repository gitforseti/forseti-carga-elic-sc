<?php
/**
 * Created by PhpStorm.
 * User: antonio-augusto
 * Date: 16/04/19
 * Time: 11:46
 */

namespace Forseti\Carga\ElicSC\Repository;

use Forseti\Carga\ElicSC\Model\Anexo;
use Forseti\Carga\ElicSC\Model\Licitacao;
use Forseti\Carga\ElicSC\Model\TipoAnexo;
use Forseti\Carga\ElicSC\Traits\ForsetiLoggerTrait;

class AnexosRepository
{
    use ForsetiLoggerTrait;

    public function insertTipoAnexo($anexo)
    {
        try{
            return TipoAnexo::firstOrCreate([
                'nm_tipo_anexo' => $anexo->nCdAnexoTipo
            ]);
        }catch (\Exception $e) {
            $this->error('erro ao inserir tipoAnexo no banco: ', ['exception' => $e->getMessage()]);
        }
    }
    public function insertAnexo($nu_licitacao, $anexo, $tipoAnexo)
    {
        try{
            Anexo::firstOrCreate([
                'id_anexo' => $anexo->codigo,
                'id_tipo_anexo' => $tipoAnexo['id_tipo_anexo'],
                'nu_licitacao' => $nu_licitacao,
                'nm_url' => $anexo->urlCompleta,
                'nm_arquivo' => $anexo->nmArquivoSugerido,
                'nm_arquivo_download' => $anexo->sNmArquivo,
                'nm_path' => $anexo->sDsParametroCriptografado,
                'dt_adicionado' => $anexo->data
            ]);
        }catch (\Exception $e) {
            $this->error('erro ao inserir anexo no banco: ', ['exception' => $e->getMessage()]);
        }
    }
    public function updateAnexo($nu_licitacao, $anexo, $tipoAnexo)
    {
        try{
            $anexoRepository = Anexo::find($anexo->id_anexo);
            $anexoRepository->id_tipo_anexo = $tipoAnexo['id_tipo_anexo'];
            $anexoRepository->nu_licitacao = $nu_licitacao;
            $anexoRepository->nm_url = $anexo->urlCompleta;
            $anexoRepository->nm_arquivo = $anexo->nmArquivoSugerido;
            $anexoRepository->nm_arquivo_download = $anexo->sNmArquivo;
            $anexoRepository->nm_path = $anexo->sDsParametroCriptografado;
            $anexoRepository->dt_adicionado = $anexo->data;
            $anexoRepository->save();
            return $anexoRepository;
        }catch (\Exception $e) {
            $this->error('erro ao atualizar flag de anexo no banco: ', ['exception' => $e->getMessage()]);
        }
    }
    public function updateFlag($nu_licitacao, $flag)
    {
        try{
            $licitacao = Licitacao::find($nu_licitacao);
            $licitacao->flag_anexo = $flag;
            $licitacao->save();
        }catch (\Exception $e) {
            $this->error('erro ao atualizar flag de anexo no banco: ', ['exception' => $e->getMessage()]);
        }
    }
}