<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) 2013-2017 Pierre du Plessis <info@customscripts.co.za>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\InvoiceBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use SolidInvoice\CoreBundle\Traits\Entity\Archivable;
use SolidInvoice\CoreBundle\Traits\Entity\TimeStampable;
use Symfony\Component\Serializer\Annotation as Serialize;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(attributes={"normalization_context"={"groups"={"recurring_invoice_api"}}, "denormalization_context"={"groups"={"create_recurring_invoice_api"}}})
 * @ORM\Entity(repositoryClass="SolidInvoice\InvoiceBundle\Repository\RecurringInvoiceRepository")
 * @ORM\Table(name="recurring_invoices")
 * @ORM\HasLifecycleCallbacks()
 * @Gedmo\Loggable()
 */
class RecurringInvoice extends BaseInvoice
{
    use Archivable;
    use TimeStampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serialize\Groups({"recurring_invoice_api", "client_api"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="frequency", type="string", nullable=true)
     * @Serialize\Groups({"recurring_invoice_api", "client_api", "create_recurring_invoice_api"})
     */
    private $frequency;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     * @Assert\NotBlank(groups={"Recurring"})
     * @Assert\Date(groups={"Recurring"})
     * @Serialize\Groups({"recurring_invoice_api", "client_api", "create_recurring_invoice_api"})
     */
    private $dateStart;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     * @Serialize\Groups({"recurring_invoice_api", "client_api", "create_recurring_invoice_api"})
     */
    private $dateEnd;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    /**
     * @return RecurringInvoice
     */
    public function setFrequency(string $frequency): self
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): ?DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime $dateStart
     *
     * @return RecurringInvoice
     */
    public function setDateStart(DateTime $dateStart = null): self
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): ?DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTime $dateEnd
     *
     * @return RecurringInvoice
     */
    public function setDateEnd(DateTime $dateEnd = null): self
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}
