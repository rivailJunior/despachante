<?php

class Venda extends CI_Controller {

    function __construct() {
        parent::__construct();
        if( !$this->session->userdata('isLoggedIn') ) {
            redirect('/Login/show_login');
        }
        $this->load->model("M_venda");
        $this->load->model("M_produto");
        $this->load->model("M_itemvenda");
        $this->data['usuario']= $this->session->userdata('isLoggedIn','nome'); 
    }//fim do construct
    
    function index() {
        $this->data['title']="Venda";
        $this->load->view('layouts/default_header',  $this->data);
        $this->load->view('venda/index',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
    
    function realizar_venda() {
         $this->data['title']="Venda";
        $listaProdutos=  $this->M_produto->select();
        $this->data['produtos']=$listaProdutos;
        $this->load->view('layouts/default_header',  $this->data);
        $this->load->view('venda/realizar_venda',$this->data);
        $this->load->view('layouts/default_footer',$this->data);
    }
   
    
    function salvarvenda()
	{
		$produtos = json_decode($_POST['venda'], true);               // { (cod, desc, qtd, preco, total) }  
		$total = json_decode($_POST['totalVenda'], true);             // { qtd itens, valor total}
		$detalhepagamento = json_decode($_POST['pagamento'], true);   // entregue, troco, tipoPag (0, 1, 2)
        $despachante = json_decode($_POST['despachante'], true);      // 0 codigo, 1 nome, 2 CRDD
		
        //echo json_encode($detalhepagamento);
           
		//$session_data = $this->session->userdata('logged_in');
		$auxdata = date('d/m/Y');
		$codlastvenda = $this->M_venda->selectlastVenda();
        $ret = $codlastvenda->row();
        if (!$ret) 
        {
            $codvenda = 1;
        } 
        else 
        {
            $codvenda =  $ret->ven_codigo + 1;
        }
        
        //echo json_encode($codvenda);
        // quem fez a venda: $session_data['pcodigo'];

        if (count($despachante) > 0) 
        {
            $desp = $despachante[0];
        } 
        else 
        {
            $desp = NULL;
        }
        
                
		$dadosVenda['ven_codigo'] = $codvenda;
		$dadosVenda['ven_des_codigo'] = $desp;//
		$dadosVenda['ven_data'] = date("Y-m-d"); //$session_data['pcodigo'];
		$dadosVenda['ven_hora'] = date('H:i:s');//$session_data['estab'];
		$dadosVenda['ven_valor_entregue'] = $detalhepagamento['entregue'];
		$dadosVenda['ven_troco'] = $detalhepagamento['troco'] ;
		$dadosVenda['ven_valor'] = $total[1];
        $dadosVenda['ven_tipoPag'] = $detalhepagamento['tipoPag'];
		
		$result = $this->M_venda->save($codvenda,$dadosVenda,$produtos);
              
        echo json_encode($result);

	}//fim do salvar venda


    function relatorio_kit_filtros()
    {
        $select = $this->input->post('sel');
        $de = $this->input->post('de');
        $ate = $this->input->post('ate');
        $codigo = $this->input->post('codigo');
        $matricula = $this->input->post('matricula');
        
        //echo $data,$data2,$matricula,$codigo;
        if((empty($de)) && (empty($ate)))
        {
            $de = date("Y-02-01");//ano-mes-dia
            $ate = date("Y-m-d");//ano-mes-dia
            $data = "ven_data between '".$de."' AND '".$ate."'";
             
        }
        else
        {
            $data = "ven_data between '".$de."' AND '".$ate."' ";
        }

      

        if($select=="1")
        {

            $data = "";
            $mat = "";
            
      
            
            $cod  = " ven_codigo = ".$codigo."";
        }
        elseif($select=="2")
        {
            
            $mat = "AND des_matricula = '".$matricula."'";
            
            $cod = "";
        }
        else
        {
            $cod = "";
            $mat = "";

         
        }
 
        $retorno = $this->M_venda->relatorioVendas($data,$cod,$mat);
        
        
          $valor_mensal = 0;
          $qtdVenda = 0;
          $qtdProdutosVendidos = 0;
            foreach ($retorno->result() as $vendas) 
            {
                  $qtdVenda++;  
                  $valor_mensal += $vendas->ven_valor;  
                  $qtdProdutosVendidos += $vendas->itv_quantidade;           
            }
        

           $htmltable  = " 
                        <thead class='theadlistar'>
                         <tr>
                            <td id='tdValorMensal' colspan='10'>
                                <span class='pageTitle'>QTD Vendas: </span>
                                <span style='font-size:40px; color:black; '>".$qtdVenda."</span>
                                <span id='totalIten' class='pageTitle'>Total Itens: </span>
                                <span style='font-size:40px; color:black; '>".$qtdProdutosVendidos."</span>
                                <span id='total' class='pageTitle'>Total R$: </span>
                                <span style='font-size:40px; color:black; '>".$valor_mensal."</span> 
                            </td>
                        </tr>";
                            
            $htmltable  .='<tr>
                            <th width="40" class="titleMain">CODIGO VENDA</th>
                            <th width="40" class="titleMain">MATRICULA</th>
                            <th width="40" class="titleMain">DATA</th>
                            <th width="40" class="titleMain">HORA</th>
                            <th width="40" class="titleMain">QTD ITENS</th>
                            <th width="40" class="titleMain">QTD PRODUTOS</th>
                            <th width="40" class="titleMain">VALOR</th>
                            <th width="40" class="titleMain">PAGO</th>
                            <th width="40" class="titleMain">TROCO</th>
                            <th id="thProdutos" width="10" class="titleMain" colspan="2">PRODUTOS</th>
                            
                        </tr>
                        </thead>
                        <tbody class="tbodylistar" align="center">
                        ';
        if($retorno->num_rows()>0)
        {
            foreach ($retorno->result() as $vendas) 
            {
                        
                   $htmltable  .=" <tr class='oi'>";
                    $htmltable .="   <td>".$vendas->ven_codigo."</td>";
                    $htmltable .="   <td>".$vendas->des_matricula."</td>";
                    $htmltable .="   <td>".$vendas->ven_data."</td>";
                    $htmltable .="   <td>".$vendas->ven_hora."</td>";
                    $htmltable .="   <td>".$vendas->itv_quantidade."</td>";
                    $htmltable .="   <td>".$vendas->total_produtos."</td>";
                    $htmltable .="   <td>".$vendas->ven_valor."</td>";
                    $htmltable .="   <td>".$vendas->ven_valor_entregue."</td>";
                    $htmltable .="   <td>".$vendas->ven_troco."</td>";
                    $htmltable .="   
                    <td class='oi2' width='10'><a class='verProdutos' id='verProd- ".$vendas->ven_codigo."'><img src=".base_url('/assets/img/pesquisar.png')." width='33px' height='33px'></a></td>
                    <td width='10'><a href=".site_url('administrador/venda/recibo_venda_2via/'.$vendas->ven_codigo)." class='imprimeRecibo'><img src=".base_url('/assets/img/impressora.png')." width='33px' height='33px'></a></td> 
                            </tr>";

            }

            } 
            else 
            {
                $htmltable .= "<td align='CENTER' colspan='11'><span>Nenhum Ficheiro Encontrado</span></td>";
            }
                  
                             $htmltable .="<tr id='produtos'></tr>
                                
                        </tbody> ";
        
        echo $htmltable;
    }
        
      
     function relatorioVendas() {
           

       if((isset($_POST['data'])) && (isset($_POST['data2']))){
             $de=$_POST['data'];
             $ate=$_POST['data2'];
             $data = "ven_data between '".$de."' AND '".$ate."' ";
        }
        else
        {
            $de = date("Y-m-01");//ano-mes-dia
            $ate = date("Y-m-d");//ano-mes-dia
            $data = "ven_data between '".$de."' AND '".$ate."' ";
        }
         $cod = "";
         $mat = "";

        
        $result = $this->M_venda->relatorioVendas($cod,$data,$mat);
        

        $dataValor = "ven_data between '".date("Y-m-01")."' AND '".date("Y-m-d")."'";
        $valor_total_mensal = $this->M_venda->valor_total_venda($dataValor);
        $valor_mensal = $valor_total_mensal->row();
        $this->data['valor_mes_atual']=$valor_mensal;
        $this->data['relatoriovenda']=$result;
        
        $this->data['title']="Relatorio vendas";
        $this->load->view('layouts/default_header',  $this->data);
        $this->load->view('venda/relatorio',  $this->data);
        $this->load->view('layouts/default_footer',  $this->data);
        
        
    }  //fim da function 

    function lista_produtos_venda()
    {
        $codigo = $_POST['codigo'];
        $produtos=$this->M_venda->lista_produto_venda($codigo);

        if($produtos->num_rows() > 0)
        {
            $i = 1;
            $htmlTD = '<tr class="openBody">';
            $htmlTD .= "<td style='background-color:#ADD8AD; font-weight: lighter; padding: 10px 15% 10px 15%;' colspan='9'>";
            
                $htmlTD .= "<span style='width:10%; color:#00993D; float:left;'><strong>N°</strong></span>";
                $htmlTD .= "<span style='width:40%; color:#00993D; float:left;'><strong>DESCRIÇÃO</strong></span>";
                $htmlTD .= "<span style='width:10%; color:#00993D; float:left;'><strong>QTD</strong></span>";
                $htmlTD .= "<span style='width:20%; color:#00993D; float:left;'><strong>PREÇO UN</strong></span>";
                $htmlTD .= "<span style='width:20%; color:#00993D; float:left;'><strong>TOTAL</strong></span>";
                $htmlTD .="<br><hr>";
               // $htmlTD .= "</td></tr>";
           // $htmlTD .= "<tr style='border:none;'>";
           // $htmlTD .= "<td style='padding-left:10%; background-color:#ADD8AD;' colspan='9'>";
            foreach ($produtos->result() as $prod) 
            {
               $htmlTD .= "<span style='width:10%; float:left;'>".$i."</strong> </span>";
               $htmlTD .= '<span style="width:40%; float:left; text-transform:uppercase;">'.$prod->pro_descricao."</span>";
               $htmlTD .= "<span style='width:10%; float:left;'>".$prod->itv_quantidade." UN</span>";
               $htmlTD .= "<span style='width:20%; letter-spacing:1px; float:left;'>R$ ".$prod->pro_valor_unitario."</span>";
               $htmlTD .= "<span style='width:20%; letter-spacing:1px; float:left;'>R$ ".$prod->pro_valor_unitario*$prod->itv_quantidade."</span>";
               $htmlTD .=  "<br>";   
               $i++;    
            }

            $htmlTD .= "<hr>";
            $htmlTD .= "<span style='color:#00993D; letter-spacing:1px; text-transform:uppercase;'><strong>".$prod->des_nome."</strong></span>";
            
            // DESPACHANTE

            $htmlTD .= "</td>";
            $htmlTD .= "</tr>";
        }
            echo $htmlTD; 

    }

    function recibo_venda_2via($code)
    {
        //$codigo = $this->input->get('codigo',true);
        $codigo = $code;

        $recibo2via = $this->M_venda->segundaViaReciboVenda($codigo);
        
        $this->data['reciboVenda2V']=$recibo2via;
       
        $produtosRecibo = $this->M_venda->lista_produto_venda($codigo);
        
        $this->data['produtosVenda']=$produtosRecibo;
        //print_r($recibo2via);

        $this->data['query']="codigo";
        
        $this->load->view('venda/reimprimir_recibo',  $this->data);
    }

}