<?php

class DetailCommande{
    private int $id;
    private int $order_id;
    private int $product_id;
    private int $quantity;
    private int $unit_price;

    public function __construct(int $id, int $order_id, int $product_id, int $quantity, int $unit_price)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getOrder_id(){
        return $this->order_id;
    }

    public function setOrder_id(int $order_id){
        $this->order_id = $order_id;
    }

    public function getProduct_id(){
        return $this->product_id;

    }

    public function setProduct_id(int $product_id){
        $this->product_id = $product_id;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

    public function getUnit_price(){
        return $this->unit_price;
    }

    public function setUnit_price(int $unit_price){
        $this->unit_price = $unit_price;
    }

}