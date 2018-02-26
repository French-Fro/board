<?php
/**
 * Created by PhpStorm.
 * User: b_vitis
 * Date: 21/02/2018
 * Time: 09:26
 */

namespace App\Services\semantic;

use Ajax\php\symfony\JquerySemantic;
use Ajax\semantic\html\base\constants\Color;
use Ajax\semantic\html\elements\HtmlLabel;
use App\Entity\Tag;

class TagsGui extends JquerySemantic{
    public function dataTable($tags){
        $dt=$this->_semantic->dataTable("dtTags", "App\Entity\Tag", $tags);
        $dt->setFields(["tag"]);
        $dt->setCaptions(["Tag"]);
        $dt->setValueFunction("tag", function($v,$tag){
            $lbl=new HtmlLabel("",$tag->getTitle());
            $lbl->setColor($tag->getColor());
            return $lbl;
        });
        $dt->addEditButton();
        $dt->setUrls(["edit"=>"tag/update"]);
        $dt->setTargetSelector("#update-tag");
        return $dt;
    }
    public function frm(Tag $tag){
        $colors=Color::getConstants();
        $frm=$this->_semantic->dataForm("frm-tag", $tag);
        $frm->setFields(["id","title","color","submit","cancel"]);
        $frm->setCaptions(["","Title","Color","Valider","Annuler"]);
        $frm->fieldAsHidden("id");
        $frm->fieldAsInput("title",["rules"=>["empty","maxLength[30]"]]);
        $frm->fieldAsDropDown("color",\array_combine($colors,$colors));
        $frm->setValidationParams(["on"=>"blur","inline"=>true]);
        $frm->onSuccess("$('#frm-tag').hide();");
        $frm->fieldAsSubmit("submit","positive","tag/submit", "#dtTags",["ajax"=>["attr"=>"","jqueryDone"=>"replaceWith"]]);
        $frm->fieldAsLink("cancel",["class"=>"ui button cancel"]);
        $this->click(".cancel","$('#frm-tag').hide();");
        $frm->addSeparatorAfter("color");
        return $frm;
    }
}