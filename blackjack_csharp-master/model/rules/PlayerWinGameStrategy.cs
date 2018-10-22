using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

namespace BlackJack.model.rules
{
    class PlayerWinGameStrategy : IWinnerStrategy
    {
        public bool isWinner(model.Player a_player, int score)
        {
            if(a_player.CalcScore() == score)
            {
                return false;
            }
            return  true;
        }
    }
}