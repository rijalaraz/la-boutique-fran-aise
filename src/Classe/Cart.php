<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
    public function __construct(private RequestStack $requestStack)
    {

    }

    public function add($product)
    {
        // Appeler la session CART de symfony
        $cart = $this->requestStack->getSession()->get('cart');

        // Ajouter une qtity +1 à mon produit
        if ($cart[$product->getId()]) {
            $cart[$product->getId()] = [
                'object' => $product,
                'qty' => $cart[$product->getId()]['qty'] + 1
            ];
        } else {
            $cart[$product->getId()] = [
                'object' => $product,
                'qty' => 1
            ];
        }

        // Créer ma session Cart
        $this->requestStack->getSession()->set('cart', $cart);
    }

    public function getCart()
    {
        return $this->requestStack->getSession()->get('cart');
    }
}