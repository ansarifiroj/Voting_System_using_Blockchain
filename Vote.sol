// SPDX-License-Identifier: MIT
pragma solidity 0.8.24;

contract Vote{
    int candiA;
    int candiB;
    
    constructor() 
    {
        candiA = 0;
        candiB = 0;
    }

    mapping (int => bool) public idToVoteCount;

    function map(int _id) public 
    {
        idToVoteCount[_id] = false;
    }

    function viewVotes() external view returns(int, int)
    {
        return (candiA, candiB);
    }

    function voteCandiA(int _id) external
    {
        if(idToVoteCount[_id] == false)
        {
            idToVoteCount[_id] = true;
            candiA += 1;
        }
    }

    function voteCandiB(int _id) external   
    {
        if(idToVoteCount[_id] == false)
        {
            idToVoteCount[_id] = true;
            candiB += 1;
        }
    }
}