<?php

namespace App\Form;

class StructureForm
{
    public function formIsValid()
    {
        return (
            ! empty($_POST['nomStructure'])
            &&
            ! empty($_POST['rueStructure'])
            &&
            ! empty($_POST['cpStructure'])
            &&
            ! empty($_POST['villeStructure'])
            &&
            ! empty($_POST['nbDonOrAct'])
            && strlen($_POST['cpStructure']) === 5
        );
    }
}