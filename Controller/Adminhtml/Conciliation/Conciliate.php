<?php
/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 *Licensed under the Apache License, Version 2.0 (the "License");
 *you may not use this file except in compliance with the License.
 *You may obtain a copy of the License at
 *
 *http://www.apache.org/licenses/LICENSE-2.0
 *
 *Unless required by applicable law or agreed to in writing, software
 *distributed under the License is distributed on an "AS IS" BASIS,
 *WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *See the License for the specific language governing permissions and
 *limitations under the License.
 *
 *  @author    PagSeguro Internet Ltda.
 *  @copyright 2016 PagSeguro Internet Ltda.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace UOL\PagSeguro\Controller\Adminhtml\Conciliation;

use UOL\PagSeguro\Controller\Ajaxable;
use UOL\PagSeguro\Model\Transactions\Methods\Conciliation;

/**
 * Class Conciliation
 * @package UOL\PagSeguro\Controller\Adminhtml
 */
class Conciliate extends Ajaxable
{
    /**
     * @var Conciliation
     */
    protected $conciliation;
    /**
     * Conciliate constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \UOL\PagSeguro\Model\Transactions\Methods\Conciliation $conciliation
    ) {
        $this->conciliation = $conciliation;
        parent::__construct($context, $resultJsonFactory);
    }

    /**
     * @return $this
     */
    public function execute()
    {
        try {
            return $this->whenSuccess(
                $this->conciliation->execute(
                    $this->getRequest()->getParam('data')
                )
            );
        } catch (\Exception $exception) {
            return $this->whenError($exception->getMessage());
        }
    }

    /**
     * Conciliation access rights checking
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('UOL_PagSeguro::Conciliation');
    }

}
