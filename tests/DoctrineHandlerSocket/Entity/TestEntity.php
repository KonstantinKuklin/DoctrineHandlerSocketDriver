<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
namespace KonstantinKuklin\DoctrineHandlerSocket\Tests\Entity;

/**
 * @Entity
 * @Table(name="hs", indexes={@Index(name="PRIMARY", columns={"key", "num"})})
 **/
class TestEntity
{

    /** @Id
     * @Column(name="key", type="string")
     * @GeneratedValue(strategy="SEQUENCE")
     */
    private $keyAttribute;

    /**
     * @Column(name="date", type="string")
     */
    private $dateAttribute;

    /**
     * @TODO understood what`s wrong with special charses
     * @Column(name="varchar", type="string")
     */
    private $someText;
}