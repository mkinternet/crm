<?php namespace Mkinternet\Crm\Classes;


class Slownie
{
/* Klasa freeware pod warunkiem zachowania informacji: Tworca jest [benY] */

    static $liczbowo;
	
    public static function zamien ($mnoznik="1",$liczba)
    {
		$wyswietl = '';

		
        $cyfra_1=", jeden, dwa, trzy, cztery, pięć, sześć, siedem, osiem,
dziewięć, dziesięć, jedenaście, dwanaście, trzynaście, czternaście,
piętnaście, szesnaście, siedemnaście, osiemnaście, dziewiętnaście";
        $cyfra_2=",, dwadzieścia, trzydzieści, czterdzieści, pięćdziesiąt,
sześćdziesiąt, siedemdziesiąt, osiemdziesiąt, dziewięćdziesiąt";
        $cyfra_3=", sto, dwieście, trzysta, czterysta, pięćset, sześćset,
siedemset, osiemset, dziewięćset";
        $cyfra1=explode(",",$cyfra_1);
        $cyfra2=explode(",",$cyfra_2);
        $cyfra3=explode(",",$cyfra_3);
        unset($cyfra_1);
        unset($cyfra_2);
        unset($cyfra_3);

        $l_p=floor($liczba/100/$mnoznik);   
        if ($l_p>0)
        {
            $wyswietl.=$cyfra3[$l_p];
            $liczba-=$l_p*100*$mnoznik;
        }
        unset($l_p);
        $l_p=floor($liczba/10/$mnoznik);   
        if ($l_p>1)
        {
            $wyswietl.=$cyfra2[$l_p];
            $liczba-=$l_p*10*$mnoznik ;
        }
        unset($l_p);
        $l_p=floor($liczba/$mnoznik);   
        if ($l_p>0)
        {
            $wyswietl.=$cyfra1[$l_p];
        }
        unset($l_p);
        return $wyswietl;
    }
    // koniec funkcji zamie�

    public static function fleksja($tabela="1",$mnoznik,$liczba)
    {
		$l_p2 = 0; $l_p3=0;
        $cyfra_1=", tysiąc, tysiące, tysięcy";
        $cyfra_2=", milion, miliony, milionów";
        $cyfra_3=", złoty, złote, złotych";
        $cyfra_4=", grosz, grosze, groszy";
        $cyfry[1]=explode(",",$cyfra_1);
        $cyfry[2]=explode(",",$cyfra_2);
        $cyfry[3]=explode(",",$cyfra_3);
        $cyfry[4]=explode(",",$cyfra_4);
        unset($cyfra_1);
        unset($cyfra_2);
        unset($cyfra_3);
        unset($cyfra_4);
        $l_p4=floor($liczba/$mnoznik);
        if (strlen($l_p4)>0 )
        {
            $l_p=floor($liczba/$mnoznik);
            $l_p=substr($l_p,strlen($l_p)-1);
        }
        if (strlen($l_p4)>1)
        {
            $l_p2=floor($liczba/$mnoznik);
            $l_p2=substr($l_p2,strlen($l_p2)-2,1);
        }
        if (strlen($l_p4)>2)
        {
            $l_p3=floor($liczba/$mnoznik);
            $l_p3=substr($l_p3,strlen($l_p3)-3,1);
        }
        if ($l_p==1 && (!$l_p2 || $l_p2==0) && (!$l_p3 || $lp_3==0))
        {
            return $cyfry[$tabela][1];
        }
        else if ($l_p==1 && ($l_p2<>0 || $l_p3<>0))
        {
            return $cyfry[$tabela][3];
        }
        else if ($l_p>1 && $l_p<5 && $l_p2<>1)
        {
            return $cyfry[$tabela][2];
        }
        else if ($l_p>1 && $l_p<5 && $l_p2==1 )
        {
            return $cyfry[$tabela][3];
        }
        else if ($l_p>4 || ($l_p==0 && ($l_p2>0 || $l_p3>0)))
        {
            return $cyfry[$tabela][3];
        }
        else if (!$l_p && !$l_p2 && !$l_p3 && $tabela>2)
        {
            if (self::$liczbowo[0]>0 && $tabela==3)
            {
                return $cyfry[$tabela][3];
            }
            if (self::$liczbowo[1]>0 && $tabela==4)
            {
                return $cyfry[$tabela][3];
            }
        }
    }
    // koniec funkcji fleksja

    public static function pokaz($liczba)
    {
		$slownie = '';
        $liczba=number_format($liczba,2, '.', '');
        $do_zamiany=explode(".",$liczba);
        self::$liczbowo[0]=$do_zamiany[0];
        self::$liczbowo[1]=$do_zamiany[1];
        if ($do_zamiany[0]>0)
        {
            $slownie.=self::zamien(1000000,$do_zamiany[0]);
            $slownie.=self::fleksja(2,1000000,$do_zamiany[0]);
            $do_zamiany[0]%=1000000;
            $slownie.=self::zamien(1000,$do_zamiany[0]);
            $slownie.=self::fleksja(1,1000,$do_zamiany[0]);
            $do_zamiany[0]%=1000;
            $slownie.=self::zamien(1,$do_zamiany[0]);
            $slownie.="".self::fleksja(3,1,$do_zamiany[0])."";
        }
        // tutaj obliczamy grosze
        if ($do_zamiany[1]>0)
        {
            $slownie.=self::zamien(1,$do_zamiany[1]);
            $slownie.="".self::fleksja(4,1,$do_zamiany[1])."";
        }
		else
		{
			$slownie .= ' zero groszy';
		}
		
		
        return $slownie;
    }

}
 
?>
