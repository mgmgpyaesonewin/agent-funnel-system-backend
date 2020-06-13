<?php

function oneOrTwoStarFreelancer($user){
    return isOneStarFreelancer($user) || isTwoStarFreelancer($user);
}