<?php

/**
 * Copyright (c) 2013, EBANX Tecnologia da Informação Ltda.
 *  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of EBANX nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

require_once dirname(dirname(dirname(__FILE__))) . '/bootstrap.php';

/**
 * The notify action controller. It's called by the EBANX robot when the payment
 * is updated.
 */
class EbanxNotifyModuleFrontController extends ModuleFrontController
{
  public function init()
  {
    parent::init();

    // It may send a single hash (string) or multiple hashes (array of strings).
    // We have to deal with them laters
    $hashes = Tools::getValue('hash_codes');

    if (is_array($hash))
    {
      foreach ($hashes as $hash)
      {
        $this->_updateOrder($hash);
      }
    }
    else
    {
      $this->_updateOrder($hashes);
    }

    echo 'OK!';
    exit();
  }

  /**
   * Updates an order status
   * @param  string $hash The EBANX payment hash
   * @return void
   */
  protected function _updateOrder($hash)
  {
      $response = \Ebanx\Ebanx::doQuery(array('hash' => $hash));

      $status = Ebanx::getOrderStatus($response->payment->status);

      $order = new Order(Ebanx::findOrderIdByHash($hash));
      $order->setCurrentState($status);
  }
}