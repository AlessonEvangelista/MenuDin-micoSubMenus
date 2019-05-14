<?php

namespace App;

class DinamicSubElement
{
    private $finalMenu = [];

    public function MenuCollection($group)
    {
        return $this->SubItensCollection($group, $this->finalMenu);
    }

    private function ItensCollection($group, array $finalMenu, $dad)
    {
        foreach ($group as $value) {
            if ($value->id_dad == $dad) {
                $finalMenu[] = ['id' => $value->id, 'descricao' => $value->descricao, 'url' => $value->url];
            }
        }
        return $finalMenu;
    }

    private function SubItensCollection($group, array $finalMenu, $level = 0)
    {
        if ($level == 0) {
            if ($finalMenu == []):
                $finalMenu = $this->ItensCollection($group, $finalMenu, null);
            endif;

            $level++;
            for ($i = 0; $i < count($finalMenu); $i++) {

                $finalMenu[$i]['sub_itens'] = [];
                $finalMenu[$i]['level'] = $level;

                $finalMenu[$i]['sub_itens'] = $this->ItensCollection($group, $finalMenu[$i]['sub_itens'], $finalMenu[$i]['recnum']);
                $finalMenu[$i]['sub_itens'] = $this->SubItensCollection($group, $finalMenu[$i]['sub_itens'], $level);
            }
        }
        else {
            $level++;
            for ($i = 0; $i < count($finalMenu); $i++) {

                $finalMenu[$i]['sub_itens'] = [];
                $finalMenu[$i]['level'] = $level;

                $finalMenu[$i]['sub_itens'] = $this->ItensCollection($group, $finalMenu[$i]['sub_itens'], $finalMenu[$i]['recnum']);
                $finalMenu[$i]['sub_itens'] = $this->SubItensCollection($group, $finalMenu[$i]['sub_itens'], $level);
            }
        }

        return $finalMenu;
    }


}
