<?php

namespace Disjfa\MozaicBundle\Security;

use Disjfa\MozaicBundle\Entity\UnsplashSeason;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UnsplashSeasonVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @param string $attribute
     * @param mixed  $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if ( ! in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        // only vote on Post objects inside this voter
        if ( ! $subject instanceof UnsplashSeason) {
            return false;
        }

        return true;
    }

    /**
     * @param string         $attribute
     * @param UnsplashSeason $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        switch ($attribute) {
            case self::VIEW:
                if ($subject->isPublic()) {
                    return true;
                }

                if ($user instanceof UserInterface) {
                    return $this->security->isGranted('ROLE_ADMIN', $user);
                }

                break;
            case self::EDIT:
                if ($user instanceof UserInterface) {
                    return $this->security->isGranted('ROLE_ADMIN', $user);
                }
                break;
        }

        return false;
    }
}
